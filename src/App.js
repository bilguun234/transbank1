import React from 'react';
import Header from './components/Header';
import Footer from './components/Footer';
import Home from './components/Home';
import AccountSummary from './components/AccountSummary';
import ContactForm from './components/ContactForm';
import './App.css';
import Section1 from './components/section1';
import Section2 from './components/section2';
import Section3 from './components/section3';


function App() {
  return (
    <div>
      
      <main>
        <Section1 />
        <Section2 />
        <Section3 />
      </main>
      
    </div>
  );
}

export default App;
