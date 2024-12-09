import React from 'react';
import translogo from '../images/transbanklogo.png';
import GoldCard from '../images/card1.png';
import DiamondCard from '../images/card2.png';
import leftTop from '../images/left_top.png';
import rightTop from '../images/right_top.png';
import rightBottom from '../images/right_bottom.png';
import leftBottom from '../images/left_bottom.png';

const Section1 = () => {
  return (
    <section id="section1" style={styles.section1}>
      {/* Content Section */}
      <div style={styles.content}>
        {/* Text Section */}
        <div style={styles.textSection}>
          <h1 style={styles.heading}>Billionaire</h1>
          <p style={styles.subheading}>Metal is the new luxury</p>
        </div>

        {/* Cards Section */}
        <div style={styles.cardsContainer}>
          <img
            src={GoldCard}
            alt="Gold Card"
            style={styles.card}
          />
          <img
            src={DiamondCard}
            alt="Diamond Card"
            style={styles.card}
          />
        </div>
      </div>

      <p style={styles.cardLabels}>
        Gold. &emsp;Premium. &emsp;&emsp;&emsp;&emsp;&emsp; Diamond. &emsp;Premium.
      </p>

      {/* Decorative Images */}
      <div style={styles.leftTopContainer}>
        <img src={leftTop} alt="Left Top" style={styles.leftTop} />
      </div>

      <div style={styles.logoContainer}>
        <img src={translogo} alt="Transbank Logo" style={styles.logo} />
      </div>

      <div style={styles.rightTopContainer}>
        <img src={rightTop} alt="Right Top" style={styles.rightTop} />
      </div>

      <div style={styles.rightBottomContainer}>
        <img src={rightBottom} alt="Right Bottom" style={styles.rightBottom} />
      </div>

      <div style={styles.leftBottomContainer}>
        <img src={leftBottom} alt="Left Bottom" style={styles.leftBottom} />
      </div>

      <div style={styles.featuresSection}>
        <div style={styles.ptext}>
          <p>Тээвэр хөгжлийн банк Монгол улсад анх удаа цэвэр</p>
          <p>метал картыг зах зээлд нэвтрүүллээ. </p>
        </div>
      </div>

      <button style={styles.button1}>Internet Banking</button>
    </section>
  );
};

const styles = {
  section1: {
    position: "relative",
    height: "100vh",
    backgroundColor: "#0C0C0D",
    color: "white",
    display: "flex",
    flexDirection: "column",
    alignItems: "center",
    justifyContent: "center",
    //paddingBottom: '140px',  //ene uildel 2dahi sectioniig doosh nuulegj bgaa ustgah heregtei ghdee dood tal text zaswar orsonii daraa
  },
  button1: {
    position: "absolute",
    top: "100px",
    right: "150px",
    padding: "10px 40px",
    backgroundColor: "#0C0C0D",
    color: "#CA996C",
    border: "1px solid #CA996C",
    borderRadius: "10px",
    cursor: "pointer",
    fontSize: "1.2rem",
  },
  logoContainer: {
    position: "absolute",
    top: "100px",
    left: "150px",
  },
  logo: {
    width: "200px",
    height: "auto",
  },
  content: {
    display: "flex",
    flexDirection: "row", // Arrange text and cards side by side
    justifyContent: "center",
    alignItems: "center",
    textAlign: "center",
  },
  textSection: {
    marginRight: "100px", // Space between text and cards
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
    width: "300px",
    margin: "0 10px",
  },
  cardLabels: {
    fontSize: "1.3rem",
    marginTop: "20px",
    marginLeft: '40vh',
    color: "#CA996C",
  },
  featuresSection: {
    position: "absolute", // Use absolute positioning
    bottom: "50px", // Adjust as needed to position it slightly above the very bottom
    left: "50%", // Center horizontally
    transform: "translateX(-50%)", // Offset the left position to truly center
    display: "flex",
    justifyContent: "center",
    alignItems: "center",
    textAlign: "center",
    padding: "50px",
    color: "#48484B",
    fontSize: "1.3rem",
  },
  ptext: {
    textAlign: "center",
    color: "#48484B",
    fontSize: "1.3rem",
    lineHeight: "0.3",
  },
  leftTopContainer: {
    position: "absolute",
    top: "0px",
    left: "0px",
  },
  leftTop: {
    height: "200px",
    width: "600px",
  },
  rightTopContainer: {
    position: "absolute",
    top: "0px",
    right: "0px",
  },
  rightTop: {
    height: "500px",
    width: "600px",
  },
  rightBottomContainer: {
    position: "absolute",
    bottom: "0px",
    right: "0px",
  },
  rightBottom: {
    height: "250px",
    width: "600px",
  },
  leftBottomContainer: {
    position: "absolute",
    bottom: "0px",
    left: "0px",
  },
  leftBottom: {
    height: "300px",
    width: "600px",
  },
};

export default Section1;
