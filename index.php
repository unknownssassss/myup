* {
    box-sizing: border-box;
    padding: 0px;
    margin: 0px;
}
@font-face {
    font-family: 'Vazir' ;
    src: url('../font/vazir.woff') format('woff');
}
@font-face {
    font-family: 'Material Icons' ;
    src: url('../font/materialicon.woff2') format('woff2');
}
body
{
    background-color: #9d9d9dc3;
    font-family: vazir ;
    direction: rtl ;
}
.material-icons {
    font-family: 'Material Icons';
    font-weight: normal;
    font-style: normal;
    font-size: 24px;  /* Preferred icon size */
    display: inline-block;
    line-height: 1;
    text-transform: none;
    letter-spacing: normal;
    word-wrap: normal;
    white-space: nowrap;
    direction: ltr;

    /* Support for all WebKit browsers. */
    -webkit-font-smoothing: antialiased;
    /* Support for Safari and Chrome. */
    text-rendering: optimizeLegibility;

    /* Support for Firefox. */
    -moz-osx-font-smoothing: grayscale;

    /* Support for IE. */
    font-feature-settings: 'liga';
}

.pro-text {
    text-align: center;
    padding: 25%;
    font-size: 25px;
    font-family: "Roboto", sans-serif;
}

body {
    font-family: "Poppins", sans-serif;
    height: 100vh;
}
h2 {
    text-align: center;
    font-size: 16px;
    font-weight: 600;
    text-transform: uppercase;
    display:inline-block;
    margin: 40px 8px 10px 8px;
    color: #cccccc;
}



/* STRUCTURE */

.wrapper {
    display: flex;
    align-items: center;
    flex-direction: column;
    justify-content: center;
    width: 100%;
    min-height: 100%;
    padding: 20px;
}

#formContent {
    -webkit-border-radius: 10px 10px 10px 10px;
    border-radius: 10px 10px 10px 10px;
    background: #fff;
    padding: 30px;
    width: auto;
    max-width: auto;
    position: relative;
    padding: 0px;
    -webkit-box-shadow: 0 30px 60px 0 rgba(0,0,0,0.3);
    box-shadow: 0 30px 60px 0 rgba(0,0,0,0.3);
    text-align: center;
}
/*td{

    width: 90%;

    max-width: 450px;
    font-size: 12px;
    text-align: center;
}*/
#formFooter {
    background-color: #f6f6f6;
    width: 100%;
    border-top: 1px solid #dce8f1;
    padding: 25px;
    text-align: center;
    float: left;
    -webkit-border-radius: 0 0 10px 10px;
    border-radius: 0 0 10px 10px;
}



/* TABS */

h2.inactive {
    color: #cccccc;
}

h2.active {
    color: #0d0d0d;
    border-bottom: 2px solid #5fbae9;
}
.txt-footer{
    color: #454545;
}
