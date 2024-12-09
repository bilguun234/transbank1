import React from "react";
import Image from '../images/shangrila.png';
import logo from '../images/transbank_white.png';
import Harhorum from '../images/harhorum.png';
import smallLogo from '../images/small_logo.png';

const Section2 = () => {
  return (
    <section id="section2" style={styles.section2}>
        
      <div style={styles.container}>  
        <div style={styles.imageContainer}>
            <img src={Image} alt="shangrila" style={styles.image} />
        </div>

        <div style={styles.logoContainer}>
            <img src={logo} alt="transbank-white" style={styles.logo} />
        </div>
      </div>  

      <div style={styles.harhorumContainer}>
            <img src={Harhorum} alt="harhorum" style={styles.imageHarhorum} />
      </div>

      <div style={styles.smallLogoContainer}>
            <img src={smallLogo} alt="smallLogos" style={styles.smallLogo} />
      </div>

      <div style={styles.smallLogoContainer2}>
            <img src={smallLogo} alt="smallLogos" style={styles.smallLogo2} />
      </div>

        
      {/* Left Column */}
      <div style={styles.leftColumn}>
        <h1 style={styles.heading2}>
          <h1>Хөгжлийг хурдасгах</h1>
          <h1>таны санхүүгийн түнш</h1>
        </h1>
        <br></br>
        <div style={styles.description2}>
          <p>Тээвэр хөгжлийн банк нь 1997 онд үүсгэн</p>
          <p>байгуулагдаж, өдгөө 27 дахь жилдээ</p>
          <p>Монгол улсын банк санхүүгийн системд</p>
          <p>тогтвортой үйл ажиллагаа явуулж буй ууган</p>
          <p>банк бөгөөд 2021 онд Кредит банктай</p>
          <p>нэгдсэнээр богино хугацаанд өндөр</p>
          <p>өсөлтийг бий болгоод зогсохгүй олон улсын</p>
          <p>жишигт нийцсэн Хувийн банкны</p>
          <p>үйлчилгээгээр тэргүүлэгч банк болоод</p>
          <p>байна.</p>
          <br />
          <p>Бид үргэлж салбартаа шинийг санаачлагч</p>
          <p>байж, харилцагчдынхаа хамтын үнэ цэнийг</p>
          <p>эрхэмлэгч санхүүгийн тогтвортой түнш банк</p>
          <p>байхаас гадна Олон улсын банк, санхүүгийн</p>
          <p>тэргүүн туршлага, орчин үеийн дэвшилтэт</p>
          <p>технологиор дамжуулан харилцагч төвтэй</p>
          <p>үйлчилгээг эрхэмлэж, ил тод, тогтвортой үйл</p>
          <p>ажиллагааг чухалчлан ажилладаг.</p>
        </div>
      </div>

      {/* Right Column */}
      <div style={styles.rightColumn}>
        <div style={styles.description22}>
          <p>Бид тогтвортой хөгжлийг</p>
          <p>дэмжсэн дэвшилтэт</p>
          <p>санхүүгийн цогц</p>
          <p>шийдлийг чадварлаг хамт</p>
          <p>олон, хариуцлагатай</p>
          <p>санхүүжилт, харилцагч</p>
          <br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
          <br/><br/><br/><br/><br/><br/><br/><br/><br/>
          <p>Харилцагчидтайгаа хамт</p>
          <p>хөгжлийг түүчээлж, үнэ</p>
          <p>цэнийг бүтээх дэлхийн</p>
          <p>түвшний банк байна.</p>
        </div>
      </div>
    </section>
  );
};

const styles = {
  section2: {
    height: "100vh",
    backgroundColor: "#0C0C0D",
    color: "white",
    display: "flex", // Use flexbox to create two columns
    flexDirection: "row",
    justifyContent: "space-evenly",
    //alignItems: "flex-start", // Align items to the top
    padding: "10px 0px",
  },
  container: {
    position: "relative", // Ensures images stack relative to this container
    width: "400px", // Set container width (adjust as needed)
    height: "300px", // Set container height (adjust as needed)
    margin: "0 auto", // Center the container
  },
  leftColumn: {
    flex: 1, // Ensures it takes more space than the right column
    paddingRight: "20px",
    display: 'flex',
    flexDirection: 'column', // Ensures content stacks vertically
    justifyContent: 'center', // Aligns content to the top
    marginLeft: '200px',
  },
  rightColumn: {
    flex: 1, // Takes less space on the right
    paddingLeft: "20px",
    display: 'flex',
    flexDirection: 'column',
    justifyContent: 'start',
    marginTop: '270px',
  },
  heading2: {
    fontSize: "1.6rem",
    color: "white",
    fontWeight: "bold",
    lineHeight: '0.3', // Adjusted for proper spacing between lines
    marginBottom: "0", // Adds space below the heading
  },
  description2: {
    fontSize: "1.2rem",
    lineHeight: '0.3', // Improved line spacing for readability
  },
  description22: {
    fontSize: "1.2rem",
    lineHeight: '0.3',
    marginTop: "40px",
  },
  image: {
    height: '100vh',
    width: '60vh',
    display: 'flex',
    justifyContent: 'flex-start',
    
  },
  logo: {
    position: "absolute", // Allows stacking
    top: "40%", // Slightly offset to make it noticeable
    left: "40%", // Slightly offset to make it noticeable
    width: "60%", // Smaller size for the second image
    zIndex: 2, // Higher stacking order
  },
  harhorumContainer: {
    height: '100px',
    width: '100px',
    marginRight: '10px',
  },
  imageHarhorum: {
    marginTop: '100px',
    height: '90vh',
    width: '150vh',
  },
  smallLogoContainer: {
    height: '10px',
    width: '10px',
    marginRight: '10px',
  },
  smallLogo: {
    height: '70px',
    width: '70px',
    marginLeft: '770px',
    marginTop: '290px',
  },
  smallLogoContainer2: {
    height: '10px',
    width: '10px',
    marginRight: '0px',
  },
  smallLogo2: {
    height: '70px',
    width: '70px',
    marginLeft: '750px',
    marginTop: '570px',
  }
};

export default Section2;
