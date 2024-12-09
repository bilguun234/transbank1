import React from "react";
import Image from '../images/plane.png';
import BackImage from '../images/back_trans_logo.png';

const Section3 = () => {
  return (
    <section style={styles.section3}>
      <div style={styles.content}>
        <h1 style={styles.heading3}>
            <h1>Mongolia's First</h1>
            <h1>Private Bank</h1>
        </h1>
        <p style={styles.description3}>
        <p>Үнэ цэнийг бүтээгч эрхэм харилцагч таны хүсэл</p>
        <p>тэмүүллийг тань нэн тэргүүний зорилтоо болгон</p>
        <p>ажиллах мэргэжлийн банкируудаар дамжуулан олон</p>
        <p>улсын жишигт нийцсэн Хувийн банкны үйлчилгээг танд</p>
        <p>хүргэнэ.</p> 
        </p>
      </div>

      

      <div style={styles.imageContainer}>
            <img src={Image} alt="PLane" style={styles.image} />
        </div>

        <div style={styles.imageContainer}>
            <img src={BackImage} alt="LOGO" style={styles.image} />
        </div>


      {/* Black Section with Features */}
      <div style={styles.featuresSection}>
        <div style={styles.feature}>
          <p>Таны тусгай хүсэлт бүхий</p>
          <p>тусгайлсан санхүүжилт</p>
        </div>
        <div style={styles.feature}>
          <p>Амьдралын хэв маягт тань</p>
          <p>төлсөрсөн онцгой үйлчилгээ</p>
        </div>
        <div style={styles.feature}>
          <p>Олон улсын нэр хүндтэй</p>
          <p>банктай дагнасан</p>
        </div>
        <div style={styles.feature}>
          <p>Зөвхөн таны хэрэгцээнд</p>
          <p>зориулсан үйлчилгээ</p>
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
    background: "linear-gradient(to bottom, white 50%, black 100%)", // Gradient color from white to black
    //backgroundImage: "url('../images/back_trans_logo.png')", // Path to your background image
    backgroundSize: "cover", // Ensures the image covers the entire section
    backgroundPosition: "center", // Centers the image
    backgroundRepeat: "no-repeat", // Prevents tiling
    color: "white",
    overflow: "hidden",
  },

  content: {
    position: 'absolute',
    padding: "40px 20px",
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
    width: "90%", // Ensure the container spans the full width
    position: "relative",
    marginTop: '100px',
    marginLeft: '200px',
  },
  image: {
    maxWidth: "100%", // Ensure the image scales proportionally
    maxHeight: "100%", // Prevent it from exceeding the container
    objectFit: "contain", // Preserve the aspect ratio of the image
  },

  featuresSection: {
    backgroundColor: "black",
    display: "flex",
    justifyContent: "space-evenly",
    alignItems: "center",
    padding: "20px 0",
  },
  feature: {
    textAlign: "center",
    color: "#b2986d", // Gold color for text
    fontSize: "0.9rem",
  },
};

export default Section3;
