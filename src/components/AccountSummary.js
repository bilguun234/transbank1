import React from 'react';

function AccountSummary() {
  return (
    <section id="accounts" style={styles.container}>
      <h2>Account Summary</h2>
      <div style={styles.card}>
        <h3>Checking Account</h3>
        <p>Balance: $5,000</p>
      </div>
      <div style={styles.card}>
        <h3>Savings Account</h3>
        <p>Balance: $12,000</p>
      </div>
    </section>
  );
}

const styles = {
  container: {
    padding: '20px',
  },
  card: {
    padding: '15px',
    margin: '10px 0',
    borderRadius: '5px',
    boxShadow: '0 2px 5px rgba(0,0,0,0.1)',
  },
};

export default AccountSummary;


