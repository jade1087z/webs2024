/*
	Song sample credits: 'F---in in the bushes' by Oasis 2000 (c)

*/
import { TimelineMax } from 'gsap';
const SG_COLOR_OFF = '#4d4d4d';
const SG_COLOR_ON = '#29ABE2';

class Player {

	constructor(song) {
		this.SPIN_STATE = 0;	// 0 = not spinning, 1 = spinning
		this.NEEDLE_STATE = 0;	//0 = off, 1 = on record, 2 = manual handling
		this.NEEDLE_SWINGDOW = 44 - 18;		// 18 == outside edge of record, 44 == inside edge of record

		this.volume = 40;
		this.needleDrag = false;
		this.recordScratch = false;
		this.volumeDrag = false;
		this.song = song || null;
		this.actors = {};
		this.tweens = {};
		this.draggables = {};

		this.masterTl = new TimelineMax();
		this.sound = new buzz.sound(this.song, {preload: true, autoplay: false, loop: false});
		this.scratchSound = new buzz.sound('https://s3.amazonaws.com/cdn.siggyworks.com/playground/record-player/record_scratch.mp3', {preload: true, autoplay: false, loop: true});

		this.actors.record = document.querySelector('#Record');
		this.actors.vinyl = this.actors.record.querySelector('#vinyl');
		this.actors.recordPlateLight = this.actors.record.querySelector('#play-state-ring');
		this.actors.startButton = document.querySelector('#StartButton');
		this.actors.startButtonLight = this.actors.startButton.querySelector('#on-light');
		this.actors.volumeControl = document.querySelector('#VolumeControl');
		this.actors.volumeKnob = this.actors.volumeControl.querySelector('#volume-knob');
		this.actors.volumeKnobLight = this.actors.volumeKnob.querySelector('#knob-light');
		this.actors.volumeTrack = this.actors.volumeControl.querySelector('#volume-track');
		this.actors.volumeLightLevel = this.actors.volumeControl.querySelector('#light-level');

		this.actors.needleArperture = document.querySelector('#NeedleArperture');
		this.actors.needleArm = this.actors.needleArperture.querySelector('#needle-arm');
		this.actors.needleFolcrum = this.actors.needleArperture.querySelector('#needle-folcrum-light');
		this.actors.needleHeadHandle = this.actors.needleArperture.querySelector('#needle-head-handle');
		this.actors.needleHeadLights = document.querySelectorAll('.needle-head-lights');

	}

	setStage() {
		//set start/stop button to stop
		TweenMax.set(this.actors.startButtonLight, {fill: SG_COLOR_OFF});

		//set volume visual level to 0
		TweenMax.set(this.actors.volumeKnob, {y: '+=' + (this.actors.volumeTrack.getBBox().height / 2) });
		TweenMax.set(this.actors.volumeKnobLight, {stroke: SG_COLOR_OFF });
		TweenMax.set(this.actors.volumeLightLevel, {scaleY: 0.0, transformOrigin: '50% 100%' });

		// set record plate light off
		TweenMax.set(this.actors.recordPlateLight, {autoAlpha: 0});
    
    // set vinyl's transformOrigin
    TweenMax.set(this.actors.vinyl, {transformOrigin:'50% 50%'});

		// set needle arm's transformOrigin
		TweenMax.set(this.actors.needleArm, {transformOrigin:'22px 62px'});

		// setup tweens
		this._setupTweens();

		// set listeners
		this._setupListeners();
	}

	_setupTweens() {
		var self = this;
		this.tweens.vinyl = new TimelineMax({repeat:-1, paused: true});
		this.tweens.vinyl.to(this.actors.vinyl,3,{transformOrigin: '50% 50%', rotation: '+=360', ease: Linear.easeNone });

		this.tweens.volumeKnob = TweenMax.fromTo(this.actors.volumeKnob, 1, 
			{y: (this.actors.volumeTrack.getBBox().height / 2)}, 
			{y: -1*(this.actors.volumeTrack.getBBox().height / 2), ease: Linear.easeNone, paused: true });
		this.tweens.volumeLightLevel = TweenMax.fromTo(this.actors.volumeLightLevel, 1, 
			{scaleY: 0.0, transformOrigin: '50% 100%' }, {scaleY: 1, paused: true, transformOrigin: '50% 100%', ease: Linear.easeNone });
	
		// make the volume knob draggable
		this.draggables.volumeKnob = Draggable.create(this.actors.volumeKnob, {
			type: 'y',
			bounds: {minY: this.actors.volumeTrack.getBBox().height / 2, maxY: -1*(this.actors.volumeTrack.getBBox().height / 2)},
			onDragEnd: function(e){
				let range = this.minY - this.maxY,
					yval = this.y - this.maxY,
					perc = yval * 100 / range;
				self.setVolume(perc);
			}
		});

		// make the needle draggable
		this.draggables.needleArm = Draggable.create(this.actors.needleArm, {
			type: 'rotation',
      throwProps: true,
			bounds: {minRotation: 0, maxRotation: 44},
			//trigger: this.actors.needleHeadHandle,
			onDrag: function(e){
				self._needleUpdate(this, self);
			},
			onDragStart: function(e){
				self.needleDrag = true;
				if(self.SPIN_STATE == 1 && self.NEEDLE_STATE == 1){
					self.sound.pause();
				}
			},
			onDragEnd: function(e){
				//console.log(this.rotation);
				if(this.rotation >= 18 && this.rotation <= 44) {
					let pos = (this.rotation - 18) / self.NEEDLE_SWINGDOW;
					self.sound.setPercent(pos*100);
					if(self.SPIN_STATE == 1) {
						self.sound.play();
					}
				}
				self.needleDrag = false;
			}
		});

		// make the vinyl scratchable
		this.draggables.vinyl = Draggable.create(this.actors.vinyl, {
			type: 'rotation',
			onDrag: function(e){
				//console.log(this.rotation);
			},
			onDragStart: function(e){
				self.recordScratch = true;
				self.tweens.vinyl.pause();
				//self.tweens.vinyl = null;
				if(self.SPIN_STATE == 1 && self.NEEDLE_STATE == 1){
					self.sound.pause();
					self.scratchSound.play();
				}
			},
			onDragEnd: function(e){
				//console.log(this.rotation);
				if(self.SPIN_STATE == 1 && self.NEEDLE_STATE == 1){
					self.tweens.vinyl.resume();
					self.scratchSound.pause();
					self.scratchSound.setPercent(0);
					self.sound.play();
				}
				self.recordScratch = false;
			}
		});
	}
	_setupListeners() {
		// start button
		this.actors.startButton.addEventListener('click', () => {
			this.startStop();
		});

		// sound playback updater
		this.sound.bind("timeupdate", (e) => {

		    if(this.NEEDLE_STATE == 1 && this.SPIN_STATE == 1 && !this.needleDrag) {
				//console.log(me.tweens.needleArm)
				let songProgress = this.sound.getPercent();
				
				if(songProgress === 100) {
					this.hangUpNeedle();
					this.startStop();
				} else {
					this._moveNeedleTo(18 + this.NEEDLE_SWINGDOW*(songProgress/100));
				}
			}
		});
	}

	_needleUpdate(tween, me) {
		var rotation = tween.target._gsTransform.rotation;
		var lights = [me.actors.needleFolcrum, me.actors.needleHeadLights];
		
		if(rotation >= 18 && rotation <= 44) {
			TweenMax.to(lights, 0.3, {fill: SG_COLOR_ON});
			me.NEEDLE_STATE = 1;
		} else {
			TweenMax.to(lights, 0.3, {fill: SG_COLOR_OFF});
			me.NEEDLE_STATE = 0;
		}
	}

	startStop() {
		if(this.SPIN_STATE) {
			// currently spinning so stop it
			this.tweens.vinyl.pause();
			TweenMax.set(this.actors.startButtonLight, {fill: SG_COLOR_OFF});
			TweenMax.to(this.actors.recordPlateLight, 2, {autoAlpha: 0});

			// stop the sound if necessary
			if(this.NEEDLE_STATE === 1) {
				this.sound.pause();
			}

			this.SPIN_STATE = 0;
		} else {
			// currently stopped so start it
			this.setVolume(this.volume);
			this.tweens.vinyl.resume();
			TweenMax.set(this.actors.startButtonLight, {fill: SG_COLOR_ON});
			TweenMax.to(this.actors.recordPlateLight, 1.4, {autoAlpha: 1, delay: 0.25});

			// play the sound if necessary
			if(this.NEEDLE_STATE === 1) {
				this.sound.play().fadeTo(this.volume,500);
			} else if(this.NEEDLE_STATE === 0) {
				let autoPlay = true;
				this.loadNeedle(autoPlay);
			}

			this.SPIN_STATE = 1;
		}
	}

	setVolume(val) {
		if(val < 0) { val = 0 }
		if(val > 100) { val = 100 }

		this.volume = val;

		//set the volume knob position
		this.tweens.volumeKnob.progress(this.volume/100);
		this.tweens.volumeLightLevel.progress(this.volume/100);

		//set the volume on the sound player
		this.sound.setVolume(this.volume);
		
		//finally
		if(this.volume > 0) {
			TweenMax.set(this.actors.volumeKnobLight, {stroke: SG_COLOR_ON });
		} else {
			TweenMax.set(this.actors.volumeKnobLight, {stroke: SG_COLOR_OFF });
		}
	}

	_moveNeedleTo(val, callback) {
		callback = callback || null;
		if(val < 0) { val = 0 }
		if(val > 100) { val = 100 }

		var origin = '22px 62px';

		TweenMax.to(this.actors.needleArm, 1, 
			{rotation:val, transformOrigin: origin, ease: Linear.easeNone, 
				onUpdate: this._needleUpdate, onUpdateParams:["{self}", this],
				onComplete: callback });
	}

	loadNeedle(andPlay) {
		andPlay = andPlay || false;
		var needleOrigin = '22px 62px';

		this._moveNeedleTo(18, () => {
			if(andPlay) {
				if(this.tweens.volumeKnob.progress() == 0) this.setVolume(this.volume);
				this.sound.setPercent(0);
				this.sound.play().fadeTo(this.volume, 500);
			}
		});
	}

	hangUpNeedle() {
		this._moveNeedleTo(0);
		this.sound.setPercent(0);
	}

	init() {
		this.setStage();
		console.log('initialized...');

	}
}

let player = new Player('https://s3.amazonaws.com/cdn.siggyworks.com/playground/record-player/fitb_sample.ogg');
player.init();