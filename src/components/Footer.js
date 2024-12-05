import React from 'react';

function Footer() {
  return (
    <footer style={styles.footer}>
      <p>&copy; 2024 Bank Name. All rights reserved.</p>
    </footer>
  );
}

const styles = {
  footer: {
    backgroundColor: '#1D6D64',
    color: 'white',
    textAlign: 'center',
    padding: '10px 0',
    position: 'absolute',
    bottom: 0,
    width: '100%',
  },
};

export default Footer;
