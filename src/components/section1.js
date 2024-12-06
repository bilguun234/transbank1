import React from 'react';
import translogo from '../images/transbanklogo.png';

const Section1 = () => {
  return (
    <section id="section1" style={styles.section1}>
        
      <div style={styles.logoContainer}>
          <img src={translogo} alt="" style={styles.logo} />
      </div>

      <div style={styles.content}>
        <h1 style={styles.heading}>Billionaire</h1>
        <p style={styles.subheading}>Metal is the new luxury</p>
        <div style={styles.cardsContainer}>
          <img
            src="path_to_gold_card" // Replace with the actual gold card image path
            alt="Gold Card"
            style={styles.card}
          />
          <img
            src="path_to_diamond_card" // Replace with the actual diamond card image path
            alt="Diamond Card"
            style={styles.card}
          />
        </div>
        <p style={styles.cardLabels}>
          Gold. Premium. &nbsp;&nbsp;&nbsp; Diamond. Premium.
        </p>
      </div>
      <div style={styles.featuresSection}>
        <div style={styles.ptext}>
          <p>Тээвэр хөгжлийн банк Монгол улсад анх удаа цэвэр</p> 
          <p>метал картыг зах зээлд нэвтрүүллээ.  </p>
        </div>
      </div>

      <button style={styles.button1}>Internet Bankng</button>

      
    </section>
    
  );
};

const styles = {
    section1: {
        position: 'relative',
        height: '100vh',
        backgroundColor: '#0C0C0D',
        color: 'white',
        display: 'flex',
        flexDirection: 'column',
        alignItems: 'center',
        justifyContent: 'flex-end',
        paddingBottom: '140px',  //ene uildel 2dahi sectioniig doosh nuulegj bgaa ustgah heregtei ghdee dood tal text zaswar orsonii daraa
    },
    button1: {
        position: "absolute",
        top: "100px",
        right: "150px",
        padding: "10px 40px",
        backgroundColor: '#0C0C0D',
        color: "#CA996C",
        border: '1px solid #CA996C',
        borderRadius: '10px',
        cursor: "pointer",
        fontSize: "1.5rem",
    },
    logoContainer: {
        position: "absolute",
        top: "100px",
        left: "150px",
    },
    logo: {
        width: "300px",
        height: "auto",
    },
    content: {
        textAlign: "center",
        dislay: 'flex',
        flexDirection: 'row',
    },
    heading: {
        fontSize: "4rem",
        fontWeight: "bold",
        fontFamily: "'Serif', cursive",
        margin: "0",
    },
    subheading: {
        fontSize: "1.5rem",
        fontFamily: "'Arial', sans-serif",
        margin: "10px 0",
    },
    cardsContainer: {
        display: "flex",
        justifyContent: "center",
        alignItems: "center",
        margin: "20px 0",
    },
      card: {
        width: "150px",
        margin: "0 10px",
    },
      cardLabels: {
        fontSize: "1rem",
        marginTop: "10px",
    },
    featuresSection: {
      display: "flex",
      justifyContent: "space-evenly",
      alignItems: "center",
      padding: "20px 0",
    },
    ptext: {
      textAlign: "center",
      color: "#48484B", 
      fontSize: "1.3rem",
      lineHeight: '0.3',
    }
  };

export default Section1;
