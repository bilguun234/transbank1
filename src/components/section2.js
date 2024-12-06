import React from "react";
import Image from '../images/shangrila.png';
import { display, height } from "@mui/system";

const Section2 = () => {
  return (
    <section id="section2" style={styles.section2}>
        
        
        <div style={styles.imageContainer}>
            <img src={Image} alt="" style={styles.image} />
        </div>

        
      {/* Left Column */}
      <div style={styles.leftColumn}>
        <h1 style={styles.heading2}>
          <h1>Хөгжлийг хурдасгах</h1>
          <h1>таны санхүүгийн түнш</h1>
        </h1>
        <br></br>
        <div style={styles.description2}>
          <p>Тээвэр хөгжлийн банк нь 1997 онд</p>
          <p>үүсгэн байгуулагдаж, өдгөө 27 дахь</p>
          <p>жилдээ Монгол улсын банк санхүүгийн</p>
          <p>системд тогтвортой үйл ажиллагаа</p>
          <p>явуулж буй ууган банк бөгөөд 2021 онд</p>
          <p>Кредит банктай нэгдсэнээр богино</p>
          <p>хугацаанд өндөр өсөлтийг бий болгоод</p>
          <p>зогсохгүй олон улсын жишигт нийцсэн</p>
          <p>Хувийн банкны үйлчилгээгээр</p>
          <p>тэргүүлэгч банк болоод байна.</p>
          <br />
          <p>Бид үргэлж салбартаа шинийг</p>
          <p>санаачлагч байж, харилцагчдынхаа</p>
          <p>хамтын үнэ цэнийг эрхэмлэгч</p>
          <p>санхүүгийн тогтвортой түнш банк</p>
          <p>байхаас гадна Олон улсын банк,</p>
          <p>санхүүгийн тэргүүн туршлага, орчин</p>
          <p>үеийн дэвшилтэт технологиор</p>
          <p>дамжуулан харилцагч төвтэй</p>
          <p>үйлчилгээг эрхэмлэж, ил тод,</p>
          <p>тогтвортой үйл ажиллагааг чухалчлан</p>
          <p>ажилладаг.</p>
        </div>
      </div>

      {/* Right Column */}
      <div style={styles.rightColumn}>
        <div style={styles.description22}>
          <p>Бид тогтвортой</p>
          <p>хөгжлийг дэмжсэн</p>
          <p>дэвшилтэт санхүүгийн</p>
          <br />
          <p>Харилцагчидтайгаа</p>
          <p>хамт хөгжлийг</p>
          <p>түүчээлж, үнэ цэнийг</p>
          <p>бүтээх дэлхийн</p>
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
  leftColumn: {
    flex: 2, // Takes up equal space on the left
    paddingRight: "20px",
  },
  rightColumn: {
    flex: 0.5, // Takes less space on the right
    paddingLeft: "20px",
  },
  heading2: {
    fontSize: "1.6rem",
    color: "white",
    fontWeight: "bold",
    lineHeight: '0.3', // Adjust line height for proper spacing
    marginBottom: "20px",
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
    display: 'flex',
    justifyContent: 'flex-start',
  }
};

export default Section2;
