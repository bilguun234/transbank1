import React from 'react';
import logoImage from '../images/transbanklogo.png';
import { border, borderRadius, fontSize } from '@mui/system';

function Header() {
  return (
    <header style={styles.header}>
  <div style={styles.logoContainer}>
    <img src={logoImage} alt="" style={styles.logo} />
    <h1 style={styles.title}>TransBank</h1>
  </div>
  <nav>
    <button style={styles.button1}>Internet Bankng</button>
  </nav>
</header>


  );
}
const styles = {
    header: {
      backgroundColor: '#0C0C0D', // Dark teal background
      color: 'white',
      padding: '15px 20px',
      display: 'flex',
      justifyContent: 'space-between', // Align nav links to the right
      alignItems: 'center',
      paddingTop: '100px',
      paddingLeft: '100px',
      paddingRight: '100px',
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
      color: 'white', // Gold color for the title
      fontSize: '24px',
      margin: 0, // Remove default margin from <h1>
    },
    link: {
      color: 'white',
      textDecoration: 'none',
      margin: '0 10px',
    },
    button1: {
      color: '#ECB743',
      backgroundColor: '#0C0C0D',
      height: '40px',
      width: '200px',
      fontSize: '14px',
      border: '1px solid #ECB743',
      borderRadius: '10px',
    }
  };
  

export default Header;
