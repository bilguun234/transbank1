import React from 'react';
import Header from './components/Header';
import Footer from './components/Footer';
import Home from './components/Home';
import AccountSummary from './components/AccountSummary';
import ContactForm from './components/ContactForm';
import './App.css';

function App() {
  return (
    <div>
      <Header />
      <main>
        <Home />
        <AccountSummary />
        <ContactForm />
      </main>
      <Footer />
    </div>
  );
}

export default App;
