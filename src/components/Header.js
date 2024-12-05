import React from 'react';
import logoImage from '../images/user.png';

function Header() {
  return (
    <header style={styles.header}>
  <div style={styles.logoContainer}>
    <img src={logoImage} alt="TransBank" style={styles.logo} />
    <h1 style={styles.title}>TransBank</h1>
  </div>
  <nav>
    <a href="#home" style={styles.link}>Home</a>
    <a href="#accounts" style={styles.link}>Accounts</a>
    <a href="#contact" style={styles.link}>Contact Us</a>
  </nav>
</header>

  );
}
const styles = {
    header: {
      backgroundColor: '#0E262A', // Dark teal background
      color: 'white',
      padding: '15px 20px',
      display: 'flex',
      justifyContent: 'space-between', // Align nav links to the right
      alignItems: 'center',
    },
    logoContainer: {
      display: 'flex', // Align logo and title horizontally
      alignItems: 'center',
    },
    logo: {
      width: '50px', // Adjust logo size
      height: '50px',
      marginRight: '10px', // Space between logo and text
    },
    title: {
      color: '#F6D99D', // Gold color for the title
      fontSize: '24px',
      margin: 0, // Remove default margin from <h1>
    },
    link: {
      color: 'white',
      textDecoration: 'none',
      margin: '0 10px',
    },
  };
  

export default Header;
