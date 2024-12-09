import React from "react";
import Image from '../images/plane.png';
import BackImage from '../images/plane_back.png';
//import TransLogo from '../images/back_trans_logo.png';

const Section3 = () => {
  return (
    <section style={styles.section3}>
      <div style={styles.content}>
        <h1 style={styles.heading3}>
            <h1>Mongolia's First</h1>
            <h1>Private Bank</h1>
        </h1>
        <p style={styles.description3}>
        <p>Үнэ цэнийг бүтээгч эрхэм харилцагч таны хүсэл тэмүүллийг</p>
        <p>тань нэн тэргүүний зорилтоо болгон ажиллах мэргэжлийн</p>
        <p>банкируудаар дамжуулан олон улсын жишигт нийцсэн</p>
        <p>Хувийн банкны үйлчилгээг танд хүргэнэ.</p>
        </p>
      </div>

      {/*<div style={styles.backContainer}>
            <img src={TransLogo} alt="transBankWhite" style={styles.imageTransLogo} />
      </div>*/}

      <div style={styles.container}>
      <div style={styles.imageContainer}>
            <img src={Image} alt="PLane" style={styles.image} />
      </div>

        <div style={styles.imageContainer}>
            <img src={BackImage} alt="LOGO" style={styles.imageback} />
        </div>
        </div>

      {/* Black Section with Features */}
      <div style={styles.featuresSection}>
        <div style={styles.feature}>
          <p>Тав тухтай орчин бүхий</p>
          <p>тусгайлсан салбарууд:</p>
        
          <hr style={styles.line}></hr>
        
          <br></br>
          <p>Амьдралын хэв маягт тань</p>
          <p>тохирсон онцгой үйлчилгээ:</p>
          <hr style={styles.line}></hr>
        </div>

        <hr style={styles.verticalLine}></hr>
        
        <div style={styles.feature}>
          <p>Олон улсын нэр хүндтэй хувийн</p>
          <p>банканд данс нээх боломжтой:</p>
        
          <hr style={styles.line}></hr>
        
          <br></br>
          <p>Бизнес үйлчилгээний</p>
          <p>танхим:</p>
          <hr style={styles.line}></hr>
        </div>
        
        <hr style={styles.verticalLine}></hr>
        
        <div style={styles.feature}>
          <p>Зөвхөн таны хэрэгцээ зорилгод</p>
          <p>нийцсэн бүтээгдэхүүн үйлчилгээ:</p>
        
          <hr style={styles.line}></hr>
        
          <br></br>
          <p>Мэдээллийн аюулгүй байдлын</p>
          <p>олон улсын стандарттай:</p>
          <hr style={styles.line}></hr>
        </div>
      </div>
    </section>
  );
};

const styles = {
   /* section3: {
        height: "100vh",
        display: "flex",
        flexDirection: "column",
        justifyContent: "space-between",
        background: "linear-gradient(to bottom, white 50%, black 100%)", // Gradient color from white to black
        color: "white",
        overflow: "hidden",
    },*/

  section3: {
    height: "100vh",
    display: "flex",
    flexDirection: "column",
    justifyContent: "space-between",
    background: 'white',//"linear-gradient(to bottom, white 50%, black 100%)", // Gradient color from white to black
    //backgroundImage: "url('../images/back_trans_logo.png')", // Path to your background image
    backgroundSize: "cover", // Ensures the image covers the entire section
    backgroundPosition: "center", // Centers the image
    backgroundRepeat: "no-repeat", // Prevents tiling
    color: "white",
    overflow: "hidden",
  },
  container: {
    position: "relative", // Ensures images stack relative to this container
    width: "70%", // Set container width (adjust as needed)
    height: "300px", // Set container height (adjust as needed)
    margin: "0 auto", // Center the container
  },
  
  content: {
    position: 'absolute',
    padding: "0px 20px",
    textAlign: "left",
  },
  heading3: {
    position: 'relative',
    left: '100px',
    top: '100px',
    fontSize: "1.6rem",
    color: "#b2986d", 
    fontWeight: "bold",
    lineHeight: '0.3',
    margin: '0',
  },
  description3: {
    position: 'relative',
    left: '100px',
    top: '100px',
    fontSize: "1.2rem",
    color: "#333",
    lineHeight: "0.3",
    marginTop: "30px",
  },
  imageContainer: {
    display: "flex", // Use Flexbox for centering
    justifyContent: "center", // Horizontally center the image
    alignItems: "center", // Vertically center the image
    height: "60%",
    width: "80%", // Ensure the container spans the full width
    position: "relative",
    marginTop: '100px',
    marginLeft: '200px',
  },
  //original plane
  image: {
    maxWidth: "151vh", // Ensure the image scales proportionally
    maxHeight: "150vh", // Prevent it from exceeding the container
    objectFit: "contain", // Preserve the aspect ratio of the image
    marginLeft: '80px',
    marginTop: '410px',
    zIndex: '2',
  },

  featuresSection: {
    backgroundColor: "black",
    display: "flex",
    justifyContent: "space-evenly",
    alignItems: "center",
    padding: "50px 200px",
  },
  feature: {
    textAlign: "start",
    alignItems: 'center',
    color: "white", 
    fontSize: "1.2rem",
    lineHeight: '0.3',
  },
  imageback: {
    maxHeight: '100vh',
    maxWidth: '180vh',
    marginTop: '40px',
    marginLeft: '-15px',
    zIndex: '1',
  },
  backContainer: {
    position: "absolute",
        bottom: "0px",
        left: "0px",
  },
  line: {
    width: '20%',
    margin: '8px auto',
    marginLeft: '0',
    backgroundColor: '#b2986d',
  },
  verticalLine: {
    width: "0.1px",
    height: "150px",
    backgroundColor: "white",
    margin: "10px auto",
  },
};

export default Section3;