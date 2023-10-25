import React from 'react'


import Logo from './header/Logo';
import Menu from './header/Menu';
import Sns from './header/Sns';
import Bar from './Bar';

const Header = () => {
  return (
    <header id='header' role='banner'>
        <Logo />
        <Menu />
        <Sns />
        <Bar />
    </header>
  )
}

export default Header