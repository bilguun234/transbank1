import React from 'react';

function Home() {
  return (
    <section id="home" style={styles.container}>
      <h2>Welcome to Bank Name</h2>
      <p>Your trusted partner for all banking needs.</p>
    </section>
  );
}

const styles = {
  container: {
    textAlign: 'center',
    padding: '50px 20px',
  },
};

export default Home;
