import React from 'react'
import { LuCat } from 'react-icons/lu';
import { Link } from 'react-router-dom';
const Logo = () => {
  return (
    <h1 className='header__logo'>
            <Link to='/' className='box'>
                <em className='box'><LuCat /></em>
                <span>FESSION<br /> 
                YOUTUBER</span>
            </Link>
        </h1>
  )
}

export default Logo