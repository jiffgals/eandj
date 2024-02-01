<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Guitarists Helper</title>
    <link rel="stylesheet" href="style.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Kumbh+Sans:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="inventory/style.css" />
    <style>
        * {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
    font-family: 'Kumbh Sans', sans-serif;
}

body {
  background: #141414;
}

a {
    text-decoration: none;
    color:  #fff;
}

span {
  font-size: 1.5rem;
  color: #ff8177;
}

#start {
  color: transparent;
}

#tool1 {
  color: transparent;
}

#tool2 {
  color: transparent;
}

#extra {
  color: transparent;
}

.text-content {
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  gap: 10px;
  width: 100%;
  padding: 10px;
  align-items: center;
  justify-content: center;
}

.navbar {
    background: #131313;
    height: 80px;
    display: flex;
    justify-content: center;
    align-items: center;
    font-size: 1.2rem;
    position: sticky;
    top: 0;
    z-index: 999;
}

.navbar__container {
    display: flex;
    justify-content: space-between;
    height: 80px;
    z-index: 1;
    width: 100%;
    max-width: 1300px;
    margin: 0 auto;
    padding: 0 50px;
}

#navbar__logo {
    background-color: #ff8177;
    background-image: linear-gradient(to top, #ff0844 0%, #ffb144 100%);
    background-size: 100%;
    -webkit-background-clip: text;
    -moz-background-clip: text;
    -webkit-text-fill-color: transparent;
    -moz-text-fill-color: transparent;
    display: flex;
    align-items: center;
    cursor: pointer;
    text-decoration: none;
    font-size: 2rem;
}

.fa-gem {
    margin-right: 0.5rem;
}

.navbar__menu {
    display: flex;
    align-items: center;
    list-style: none;
    text-align: center;
}

.navbar__item {
    height: 80px;
}

.navbar__links {
    color: #fff;
    display: flex;
    align-items: center;
    justify-content: center;
    text-decoration: none;
    padding: 0 1rem;
    height: 100%;
}

.navbar__btn {
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 0 1rem;
    width: 100%;
}

.button {
    display: flex;
    justify-content: center;
    align-items: center;
    text-decoration: none;
    padding: 10px 20px;
    height: 100%;
    width: 100%;
    border: none;
    outline: none;
    border-radius: 4px;
    background: #f77062;
    color: #fff;
}

.button:hover {
    background: #4837ff;
    transition: all 0.3s ease;
}

.navbar__links:hover {
    color: #f77062;
    transition: all 0.3s ease;
}

@media screen and (max-width: 960px) {
    .navbar__container {
        display: flex;
        justify-content: space-between;
        height: 80px;
        z-index: 1;
        width: 100%;
        max-width: 1300px;
        padding: 0;
    } /* This will trigger navigation button to show when screen reduced to 960pixel */
        /*Without it all resolution below 960px won't work also */

    .navbar__menu {
        display: grid;
        grid-template-columns: auto;
        margin: 0;
        width: 100%;
        position: absolute;
        top: -1000px;
        opacity: 0;
        transition: all 0.5s ease;
        height: 50vh;
        z-index: -1;
        background: #131313;
    }

    .navbar__menu.active {
        background: #131313;
        top: 100%;
        opacity: 1;
        transition: all 0.5s ease;
        z-index: 99;
        height: 50vh;
        font-size: 1.6rem;
    } /* This will show navigation content in 3 white lines button */

    #navbar__logo {
        padding-left: 20px;
    } /* This will add padding in navigation logo */

    .navbar__toggle .bar {
        width: 25px;
        height: 3px;
        margin: 5px auto;
        transition: all 0.3s ease-in-out;
        background: #fff;
    } /* This is for 3 lines in navigation */

    .navbar__item {
        width: 100%;
    }

    .navbar__links {
        text-align: center;
        padding: 2rem;
        width: 100%;
        display: table;
    }

    #mobile-menu {
        position: absolute;
        top: 20%;
        right: 5%;
        transform: translate(5%, 20%);
    }

    .navbar__btn {
        padding-bottom: 2rem;
    }

    .button {
        display: flex;
        justify-content: center;
        align-items: center;
        width: 80%;
        height: 70px;
        margin: 0;
    } /* This is the button along sign up in navbar__toggle */

    .navbar__toggle .bar {
        display: block;
        cursor: pointer;
    } /* This is the 3 lines toggle button */

    #mobile-menu.is-active .bar:nth-child(2) {
        opacity: 0;
    }

    #mobile-menu.is-active .bar:nth-child(1) {
        transform: translateY(8px) rotate(45deg);
    }

    #mobile-menu.is-active .bar:nth-child(3) {
        transform: translateY(-8px) rotate(-45deg);
    }

    .text-content {
      display: grid;
      grid-template-columns: repeat(1, 1fr);
      width: 100%;
      padding: 10px;
      align-items: center;
      justify-content: center;
    }
}

/* Guitar Section */
.main {
    background-color: #141414;
}

.main__container {
    display: grid;
    grid-template-columns: 1fr 1fr;
    align-items: center;
    justify-content: center;
    margin: 0 auto;
    height: 90vh;
    background-color: #141414;
    z-index: 1;
    width: 100%;
    max-width: 1300px;
    padding: 0 50px;
}

.main__content h1 {
    font-size: 4rem;
    background-color: #ff8177;
    background-image: linear-gradient(to top, #ff0044 0%, #ffb144 100%);
    background-size: 100%;
    -webkit-background-clip: text;
    -moz-background-clip: text;
    -webkit-text-fill-color: transparent;
    -moz-text-fill-color: transparent;
}

.main__content h2 {
    
    font-size: 4rem;
    background-color: #ff8177;
    background-image: linear-gradient(to top, #b721ff 0%, #21d4fd 100%);
    background-size: 100%;
    -webkit-background-clip: text;
    -moz-background-clip: text;
    -webkit-text-fill-color: transparent;
    -moz-text-fill-color: transparent;
}

.main__content p {
    margin-top: 1rem;
    font-size: 2rem;
    font-weight: 700;
    color: #fff;
}

.main__btn {
    font-size: 1rem;
    background-image: linear-gradient(to top, #f77862 0%, #fe5196 100%);
    padding: 14px 32px;
    border: none;
    border-radius: 4px;
    color: #fff;
    margin-top: 2rem;
    cursor: pointer;
    position: relative;
    transition: all 0.3s;
    outline: none;
}

.main__btn a{
    position: relative;
    z-index: 2;
    color: #fff;
    text-decoration: none;
}

.main__btn:after {
    position: absolute;
    content: '';
    top: 0;
    left: 0;
    width: 0;
    height: 100%;
    background: #4837ff;
    transition: all 0.35s;
    border-radius: 4px;
}

.main__btn:hover {
    color: #fff;
}

.main__btn:hover:after {
    width: 100%;
}

.main__img--container {
    text-align: center;
    height: 100%;
}

@main__img {
    height: 80%;
    width: 80%;
}

/* mobile responsive */
/* with this all the component beneathe this resolution will be applied when screen size reach 720px */
@media screen and (max-width: 760px) {
    .main__container {
        display: grid;
        grid-template-columns: auto;
        align-items: center;
        justify-content: center;
        width: 100%;
        margin: 0 auto;
        height: 90vh;
    }

    .main__content {
        text-align: center;
        margin-bottom: 4rem;
    }

    .main__content h1 {
        font-size: 2.5rem;
        margin-top: 2rem;
    }

    .main__content h2 {
        font-size: 3rem;
    }

    .main__content p {
        margin-top: 1rem;
        font-size: 1.5rem;
    }
}

@media screen and (max-width: 518px) {
    .main__container {
        display: grid;
        grid-template-columns: auto;
        align-items: center;
        justify-content: center;
        width: 100%;
        margin: 0 auto;
        height: 90vh;
    }

    .main__content {
        text-align: center;
        margin-bottom: 4rem;
        align-items: center;
        justify-content: center;
    }
  
    .main__content h1 {
        font-size: 2rem;
        margin-top: 3rem;
        align-items: center;
        justify-content: center;
    }

    .main__content h2 {
        font-size: 2rem;
        align-items: center;
        justify-content: center;
    }

    .main__content p {
        margin-top: 2rem;
        font-size: 1.5rem;
        align-items: center;
        justify-content: center;
    }

    .main__btn {
        padding: 12px 36px;
        margin: 2.5rem 0;
    }
    .services {
        background: #141414;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        height: 100%;
    }

    services__container, img {
      border-radius: 10px;
    }
}

/* Service Section CSS */
.services {
    background: #141414;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    height: 100%;
}

services__container, img {
  border-radius: 10px;
}

.services h1 {
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: #ff8177;
    background-image: linear-gradient(to right, 
    #ff8177 0%, 
    #ff867a 0%, 
    #ff8c7f 21%, 
    #f99185 52%, 
    #cf556c 78%, 
    #b12a5b 100%
    );
    background-size: 100%;
    margin-bottom: 1rem;
    font-size: 2.5rem;
    -webkit-background-clip: text;
    -moz-background-clip: tent;
    -webkit-text-fill-color: transparent;
    -moz-text-fill-color: transparent;
}

.services__container {
    display: flex;
    align-items: center;
    justify-content: center;
    flex-wrap: wrap;
    color: #fff;
}

.services__card {
    margin: 1rem;
    height: 525px;
    width: 400px;
    border-radius: 4px;
    background-image: linear-gradient(to bottom, rgba(0,0,0,0) 0%, rgba(17, 17, 17, 0.6) 100%), url('https://www.doremistudios.com.au/wp-content/uploads/2022/09/Circle-of-fifths-1024x1003.png');
    background-size: cover;
    position: relative;
    color: #fff;
    align-items: center;
    justify-content: center;
}

.services__card:nth-child(2) {
    background-image: linear-gradient(to bottom, rgba(0,0,0,0) 0%, rgba(17, 17, 17, 0.6) 100%), url('https://m.media-amazon.com/images/I/710w+zjgwEL._SY425_.jpg');
}

.services h2 {
    position: absolute;
    top: 358px;
    left: 30px;
}

.services__card p {
    position: absolute;
    top: 480px;
    left: 38px;
}

.services__card button {
    color: #fff;
    padding: 10px 20px;
    border: none;
    outline: none;
    border-radius: 12px;
    background: #f77862;
    position: absolute;
    top: 420px;
    left: 38px;
    font-size: 1rem;
    cursor: pointer;
}

.services__card:hover {
    transform: scale(1.075s);
    transition: 0.s ease-in;
    cursor: pointer;
}

@media screen and (max-width: 960px) {
    .services {
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .services h1 {
        font-size: 2rem;
        margin-top: 12rem;
    }
}

@media screen and (max-width: 480px) {
    .services {
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .services h1 {
        font-size: 1.2rem;
    }

    .services__card {
        width: 300px;
    }
}

/* Footer CSS */
.footer__container {
    background-color: #141414;
    padding: 5rem;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
}

#footer__logo {
    color: #fff;
    display: flex;
    align-items: center;
    cursor: pointer;
    text-decoration: none;
    font-size: 2rem;
}

.footer__links {
    width: 100%;
    max-width: 1000px;
    display: flex;
    justify-content: center;
}

.footer__link--wrapper {
    display: flex;
}

.footer__link--items {
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    margin: 16px;
    text-align: left;
    width: 100%;
    box-sizing: border-box;
}

.footer__link--items h2 {
    margin-bottom: 16px;
    margin-top: 26px;
}

.footer__link--items > h2 {
    color: #fff;
}

.footer__link--items a {
    color: #fff;
    text-decoration: none;
    margin-bottom: 0.5rem;
}

.footer__link--items a:hover {
    color: #e9e9e9;
    transition: 0.3s ease-out;
}

.social__icon--link {
    color: #fff;
    font-size: 24px;
}

.social__media {
    max-width: 1000px;
    width: 100%;
}

.social__media--wrap {
    display: flex;
    justify-content: space-between;
    align-items: center;
    width: 90%;
    max-width: 1000px;
    margin: 40px auto 0 auto;
}

.social__icons {
    display: flex;
    justify-content: space-between;
    align-items: center;
    width: 240px;
}

.social__logo {
    color: #fff;
    justify-self: flex-start;
    margin-left: 20px;
    cursor: pointer;
    text-decoration: none;
    font-size: 2rem;
    display: flex;
    align-items: center;
    margin-bottom: 16px;
}

.website__rights {
    color: #fff;
}

@media screen and (max-width: 820px) {
    .footer__links {
        padding-top: 2rem;
    }

    #footer__logo {
        margin-bottom: 2rem;
    }

    .website__rights {
        margin-bottom: 2rem;
    }

    .footer__link--wrapper {
        flex-direction: column;
    }

    .social__media--wrap {
        flex-direction: column;
    }
}

@media screen and (max-width: 480px) {
    .footer__link--items {
        margin: 0;
        padding: 10px;
        width: 100%;
    }
}

/*for inventory program*/

table {
    width: 100%;
    border-collapse: collapse;
    font-size: 18px;
    font-weight: bold;
    color: #fff;
  }
  
  table, td, th {
    border: 1px solid #f55a00;
    padding: 5px;
    text-align: left;
  }
  
  table span {
      background: green;
      color: #fff;
      border-radius: 4px;
      padding: auto;
  }
  
  table input {
      background: #fff;
      color: #000;
      border: 1px solid #f06a1d;
      border-radius: 4px;
      width: 97%;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 2px 6px 2px 16px;
  }
  
  table button {
      background: #f55b5b;
      color: #fff;
      border: 1px solid #f76c1c;
      border-radius: 4px;
      padding: 2px 4px 2px 4px;
      display: flex;
      align-items: center;
      justify-content: center;
  }
  
  form {
    margin-bottom: 1px;
    color: #fff;
    display: flex;
    align-items: center;
    justify-content: center;
  }
  
  .search {
    background: #fff;
    color: #fff;
    text-transform: none;
    border: 1px solid #fff;
    border-radius: 4px;
    padding: 10px;
    margin-right: 0px;
    margin-bottom: 1px;
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
  }
  
  form input {
    background: #fff;
    color: #000;
    text-transform: none;
    border: 1px solid #fa3e3e;
    border-radius: 4px;
    padding: 4px;
    margin-right: 10px;
    margin-bottom: 1px;
    width: 100%;
  }
  
  form button {
      background: #ff4800;
      color: #fff;
      font-weight: bold;
      text-transform: uppercase;
      border: 1px solid #e9551a;
      border-radius: 4px;
      padding: 4px;
      display: flex;
      align-items: center;
      justify-content: center;
      width: 100%;
  }
  
  text input {
    background: yellow;
    color: red;
    text-transform: none;
    border: 1px solid #e0a914;
    border-radius: 4px;
    padding: 4px;
    margin-right: 10px;
    margin-bottom: 1px;
  }

  .subject {
    background: #fff;
    color: #fc3434;
    font-size: 1.6rem;
    text-shadow: rgba(0, 0, 0, 5);
    border: 1px solid #fff;
    border-radius: 10px 10px 0 0;
    width: relative;
    padding: 4px 20px 4px 20px;
  }
    
  span, .alert {
    padding: 10px 0 0 0;
    color: rgb(245, 48, 48);
    font-weight: bolder;
   } 
    
  span, .caution {
    color: rgb(253, 125, 19);
    font-weight: bold;
   } 
    </style>
</head>
<body>
    <nav class="navbar">
        <div class="navbar__container">
            <a href="C:\xampp\htdocs\Guitarist Helper\index.html" id="navbar__logo">
                <!-- This is the Gear logo attached in navigation above -->
                <svg height="50px" width="50px" 
                version="1.1" 
                id="Layer_1" 
                xmlns="http://www.w3.org/2000/svg" 
                xmlns:xlink="http://www.w3.org/1999/xlink" 
                viewBox="0 0 512 512" 
                xml:space="preserve" 
                fill="#000000">
                <g id="SVGRepo_bgCarrier" 
                stroke-width="0"></g>
                <g id="SVGRepo_tracerCarrier" 
                stroke-linecap="round" 
                stroke-linejoin="round"></g>
                <g id="SVGRepo_iconCarrier"> 
                    <g> 
                        <path style="fill:#ea672e;" 
                        d="M351.104,221.877v-79.494h-36.712c-2.775-9.353-6.495-18.298-11.066-26.717l25.959-25.959 l-56.211-56.21l-25.959,25.959c-8.418-4.571-17.365-8.291-26.717-11.066V11.678h-79.494V48.39 c-9.353,2.775-18.298,6.496-26.717,11.066L88.229,33.497L32.018,89.708l25.959,25.959c-4.571,8.418-8.291,17.365-11.066,26.717 H10.199v79.494h36.712c2.775,9.353,6.495,18.298,11.066,26.717l-25.959,25.959l56.211,56.21l25.959-25.959 c8.418,4.571,17.365,8.291,26.717,11.066v36.712h79.494V315.87c9.353-2.775,18.298-6.496,26.717-11.066l25.959,25.959l56.211-56.21 l-25.959-25.959c4.571-8.418,8.291-17.365,11.066-26.717H351.104z M180.651,245.954c-35.249,0-63.825-28.575-63.825-63.825 s28.575-63.825,63.825-63.825s63.825,28.575,63.825,63.825S215.901,245.954,180.651,245.954z"></path> 
                        <path style="fill:#ea672e;" 
                        d="M484.685,457.985l17.116-42.866l-19.797-7.904c0.517-5.641,0.438-11.266-0.215-16.79l19.588-8.409 l-18.208-42.413l-19.588,8.409c-3.555-4.278-7.579-8.209-12.024-11.72l7.904-19.797l-42.866-17.116l-7.904,19.797 c-5.641-0.517-11.266-0.438-16.79,0.215l-8.409-19.588l-42.413,18.208l8.409,19.588c-4.278,3.555-8.209,7.579-11.72,12.024 l-19.797-7.904l-17.116,42.866l19.797,7.904c-0.517,5.641-0.438,11.266,0.215,16.79l-19.588,8.409l18.208,42.413l19.588-8.409 c3.555,4.278,7.579,8.209,12.024,11.72l-7.904,19.797l42.866,17.116l7.904-19.797c5.641,0.517,11.266,0.438,16.79-0.215 l8.409,19.588l42.413-18.208l-8.409-19.588c4.278-3.555,8.209-7.579,11.72-12.024L484.685,457.985z M387.586,434.267 c-19.008-7.589-28.264-29.151-20.675-48.159c7.589-19.008,29.151-28.264,48.159-20.675c19.008,7.589,28.264,29.151,20.675,48.159 C428.155,432.6,406.593,441.857,387.586,434.267z"></path> 
                    </g> 
                    <path d="M339.485,274.553c0-2.705-1.075-5.3-2.987-7.212l-20.721-20.721c2.258-4.73,4.271-9.589,6.023-14.544h29.306 c5.633,0,10.199-4.566,10.199-10.199v-79.494c0-5.633-4.566-10.199-10.199-10.199H321.8c-1.752-4.954-3.765-9.814-6.023-14.544 l20.722-20.721c3.983-3.983,3.983-10.441,0-14.425l-56.211-56.21c-3.983-3.982-10.441-3.982-14.424,0l-20.722,20.721 c-4.731-2.258-9.589-4.27-14.544-6.023V11.678c0-5.633-4.566-10.199-10.199-10.199h-79.494c-5.633,0-10.199,4.566-10.199,10.199 v29.305c-4.953,1.751-9.813,3.764-14.544,6.023L95.44,26.285c-3.983-3.983-10.441-3.983-14.424,0l-56.21,56.21 c-3.983,3.983-3.983,10.441,0,14.425l20.721,20.721c-2.258,4.73-4.271,9.59-6.023,14.544H10.199C4.566,132.184,0,136.751,0,142.384 v79.494c0,5.633,4.566,10.199,10.199,10.199h29.305c1.752,4.954,3.764,9.814,6.023,14.544l-20.721,20.721 c-1.912,1.912-2.987,4.507-2.987,7.212s1.075,5.299,2.987,7.212l56.21,56.211c1.912,1.912,4.507,2.987,7.212,2.987 c2.705,0,5.299-1.075,7.212-2.987l20.721-20.722c4.731,2.258,9.59,4.271,14.544,6.023v29.305c0,5.633,4.566,10.199,10.199,10.199 h79.494c5.633,0,10.199-4.566,10.199-10.199v-29.305c4.954-1.752,9.813-3.764,14.544-6.023l20.721,20.722 c1.912,1.912,4.507,2.987,7.212,2.987s5.3-1.075,7.212-2.987l56.21-56.211C338.41,279.852,339.485,277.258,339.485,274.553z M273.074,316.34l-18.747-18.747c-3.194-3.193-8.109-3.907-12.079-1.751c-7.834,4.253-16.162,7.702-24.752,10.251 c-4.329,1.285-7.298,5.263-7.298,9.778v26.513h-59.095v-26.513c0-4.515-2.969-8.493-7.298-9.778 c-8.59-2.549-16.917-5.998-24.752-10.251c-3.97-2.155-8.882-1.443-12.079,1.751L88.227,316.34l-41.786-41.787l18.747-18.746 c3.194-3.194,3.907-8.109,1.751-12.079c-4.253-7.834-7.702-16.162-10.251-24.751c-1.284-4.329-5.263-7.298-9.778-7.298H20.398 v-59.095h26.513c4.515,0,8.494-2.969,9.778-7.299c2.549-8.59,5.998-16.917,10.251-24.751c2.155-3.97,1.443-8.885-1.751-12.079 L46.442,89.708l41.786-41.786l18.747,18.747c3.194,3.193,8.109,3.907,12.078,1.751c7.835-4.253,16.163-7.702,24.752-10.251 c4.329-1.285,7.298-5.263,7.298-9.778V21.877h59.095V48.39c0,4.515,2.969,8.493,7.298,9.778c8.591,2.55,16.918,5.998,24.752,10.251 c3.972,2.156,8.885,1.443,12.078-1.751l18.747-18.747l41.786,41.786l-18.747,18.747c-3.194,3.194-3.906,8.109-1.751,12.079 c4.252,7.832,7.701,16.159,10.251,24.751c1.285,4.329,5.263,7.298,9.778,7.298h26.513v59.095H314.39 c-4.515,0-8.493,2.969-9.778,7.298c-2.55,8.592-5.999,16.92-10.251,24.752c-2.155,3.971-1.443,8.885,1.751,12.079l18.747,18.746 L273.074,316.34z"></path> 
                    <path d="M254.675,182.13c0-40.817-33.207-74.024-74.024-74.024c-40.816,0-74.023,33.207-74.023,74.024s33.207,74.024,74.023,74.024 C221.469,256.154,254.675,222.947,254.675,182.13z M127.027,182.13c0-29.569,24.056-53.625,53.624-53.625 s53.625,24.056,53.625,53.625s-24.056,53.625-53.625,53.625S127.027,211.698,127.027,182.13z"></path> 
                    <path d="M271.987,203.528c-5.315-1.875-11.138,0.914-13.011,6.226c-11.687,33.139-43.164,55.404-78.325,55.404 c-5.633,0-10.199,4.566-10.199,10.199s4.566,10.199,10.199,10.199c43.795,0,83.002-27.736,97.561-69.017 C280.086,211.227,277.299,205.401,271.987,203.528z"></path> 
                    <path d="M273.878,171.931c-5.633,0-10.199,4.566-10.199,10.199c0,1.32-0.031,2.651-0.092,3.953 c-0.263,5.627,4.085,10.402,9.711,10.665c0.163,0.007,0.324,0.011,0.486,0.011c5.414,0,9.924-4.258,10.18-9.722 c0.075-1.62,0.114-3.271,0.114-4.908C284.077,176.497,279.511,171.931,273.878,171.931z"></path> 
                    <path d="M418.852,355.962c-24.202-9.664-51.75,2.165-61.412,26.365c-9.663,24.201,2.164,51.75,26.364,61.412l0,0 c5.73,2.288,11.643,3.371,17.466,3.371c18.773,0,36.571-11.264,43.946-29.735C454.879,393.175,443.052,365.625,418.852,355.962z M426.273,409.811c-2.66,6.663-7.757,11.891-14.348,14.722c-6.592,2.83-13.892,2.924-20.556,0.263l0,0 c-13.755-5.492-20.477-21.15-14.985-34.905s21.152-20.476,34.905-14.985C425.043,380.398,431.765,396.056,426.273,409.811z"></path> 
                    <path d="M511.173,411.095c-1.067-2.486-3.078-4.446-5.59-5.448l-13.045-5.208c0.008-1.171-0.007-2.341-0.044-3.51l12.906-5.541 c2.486-1.067,4.446-3.078,5.448-5.59c1.003-2.512,0.967-5.32-0.1-7.805l-18.209-42.413c-2.221-5.175-8.22-7.572-13.396-5.348 l-12.906,5.541c-0.822-0.832-1.659-1.649-2.514-2.45l5.209-13.045c2.089-5.231-0.459-11.165-5.69-13.254l-42.866-17.116 c-5.229-2.087-11.165,0.459-13.254,5.69l-5.209,13.045c-1.167-0.009-2.34,0.007-3.51,0.044l-5.54-12.908 c-1.067-2.486-3.078-4.446-5.59-5.448c-2.511-1.003-5.32-0.968-7.805,0.1l-42.413,18.209c-5.176,2.222-7.571,8.22-5.348,13.396 l5.541,12.906c-0.832,0.822-1.649,1.66-2.45,2.514l-13.044-5.209c-2.512-1.003-5.32-0.968-7.805,0.1 c-2.486,1.067-4.446,3.078-5.448,5.589L291.384,380.8c-2.089,5.231,0.459,11.165,5.69,13.254l13.045,5.209 c-0.008,1.17,0.007,2.341,0.044,3.51l-12.906,5.541c-2.486,1.067-4.446,3.078-5.448,5.59c-1.003,2.512-0.967,5.32,0.1,7.805 l18.209,42.413c1.067,2.486,3.078,4.446,5.59,5.448c2.511,1.003,5.32,0.968,7.805-0.1l12.906-5.541 c0.822,0.832,1.659,1.649,2.514,2.45l-5.209,13.045c-2.089,5.231,0.459,11.165,5.69,13.254l42.866,17.116 c1.215,0.485,2.499,0.727,3.782,0.727c1.37,0,2.741-0.276,4.024-0.827c2.486-1.067,4.446-3.078,5.448-5.59l5.208-13.044 c1.169,0.005,2.342-0.007,3.51-0.045l5.541,12.906c2.221,5.176,8.217,7.57,13.396,5.348l42.413-18.209 c2.486-1.067,4.446-3.078,5.448-5.59c1.003-2.512,0.967-5.32-0.1-7.805l-5.541-12.906c0.832-0.822,1.649-1.659,2.45-2.514 l13.045,5.209c5.229,2.087,11.165-0.459,13.254-5.69l17.116-42.866C512.276,416.388,512.24,413.58,511.173,411.095z M478.995,444.73 l-10.325-4.122c-4.194-1.675-8.989-0.393-11.786,3.152c-3.039,3.849-6.484,7.383-10.236,10.502 c-3.474,2.887-4.634,7.716-2.852,11.867l4.386,10.216l-23.67,10.161l-4.386-10.216c-1.782-4.15-6.079-6.633-10.567-6.105 c-4.845,0.572-9.779,0.635-14.663,0.187c-4.497-0.41-8.729,2.182-10.403,6.375l-4.123,10.325l-23.922-9.552l4.122-10.325 c1.675-4.193,0.393-8.989-3.152-11.786c-3.849-3.039-7.383-6.484-10.502-10.236c-2.887-3.474-7.716-4.635-11.867-2.852 l-10.216,4.386l-10.161-23.67l10.216-4.386c4.151-1.782,6.636-6.082,6.105-10.568c-0.572-4.844-0.635-9.777-0.188-14.662 c0.412-4.496-2.182-8.728-6.374-10.403l-10.325-4.123l9.552-23.922l10.325,4.123c4.194,1.674,8.989,0.392,11.787-3.152 c3.04-3.85,6.484-7.384,10.235-10.501c3.474-2.887,4.635-7.716,2.853-11.867l-4.386-10.216l23.67-10.161l4.386,10.216 c1.782,4.15,6.078,6.633,10.567,6.105c4.847-0.572,9.781-0.634,14.662-0.188c4.499,0.411,8.729-2.181,10.404-6.375l4.123-10.326 l23.922,9.552l-4.123,10.326c-1.675,4.193-0.392,8.989,3.152,11.786c3.85,3.04,7.383,6.484,10.501,10.235 c2.888,3.474,7.716,4.635,11.867,2.853l10.216-4.386l10.161,23.67l-10.216,4.386c-4.151,1.782-6.635,6.082-6.105,10.568 c0.572,4.845,0.635,9.777,0.188,14.661c-0.413,4.497,2.181,8.729,6.375,10.404l10.325,4.123L478.995,444.73z"></path> 
                </g>
                </svg> GT
            </a>
            <div class="navbar__toggle" id="mobile-menu">
                <span class="bar"></span> 
                <span class="bar"></span>
                <span class="bar"></span>
            </div>
            <ul class="navbar__menu">
                <li class="navbar__item">
                    <a href="https://codepen.io/jiffen/full/vYbzvoY" target="_blank" class="navbar__links">Home</a>
                </li>
                <li class="navbar__item">
                    <a href="https://codepen.io/jiffen/full/vYbzbzy" target="_blank" class="navbar__links">Tools</a>
                </li>
                <li class="navbar__item">
                    <a href="https://codepen.io/jiffen/full/gOqdyoY" target="_blank" class="navbar__links">Extra</a>
                </li>
                <li class="navbar__btn">
                    <a href="https://codepen.io/jiffen/full/gOqdyoY" target="_blank" class="button">Sign Up</a>
                </li>
            </ul>   
        </div>
    </nav>

    <!-- Hero Section-->
    <div class="main">
        <div class="main__container">
            <div class="main__content">
                <h1>Inventory</h1>
                <h2>Management System</h2>
                <p>Navigate your stored data at ease</p>
                <button class="main__btn"><a href="#extra">Encode Now</a></button>
            </div>
            <div class="main__img--container">
                <!-- This is the content image in the home page -->
                <img src="https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEhGtdl65iiLTMfaoBaO4qX9-veDeHkUm4LztwnCxUyT0dSSsXjnXVBply3F5-PCkaSip-xWAaScFsDfuRkgsX4NTOdbEbDEqBIwYuUxQlXCfKWRfRpSQP6q6FhzttRyrbaEtywjU0PrkDSoRvHF8ac_RVJXUKxCDwpP9Si8AdxR5ZdIBAGeibSsPM9-1-E/s1600/%E2%80%94Pngtree%E2%80%94doodle%20colorful%20guitar%20man%20illustration_4200744.png" width="80%" height="80%" alt="pic" id="main__img">
            </div>
        </div>
    </div>
<div id="extra"></div>
    <!-- Program Section--><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
<div class="services">
    <div class="subject">Encode Your Products - Item Name, Quantity, and Price</div>
    <div class="search">
    <form>
            <input type="text" id="searchInput" onkeyup="searchTable()" placeholder="Search for products...">
    </form>
    </div>
    <form id="inventoryForm">
        <input type="text" id="productName" placeholder="Product Name">
        <input type="hidden" id="productQuantity" placeholder="Quantity"> <!--remove comments function to display quantity input field-->
        <button type="submit" onclick="addProduct()">Add Product</button>
    </form>
    <table id="inventoryTable">    
        <tr>
        <th>Product Name</th>
        <th>Quantity</th>
        <th>Price</th>
        <th>Actions</th>
        </tr>
    </table>
    <br/>
    <span class="alert" >Caution:</span> <span class="caution">Pls Do not clear your Browser Cache and Cookies to avoid Headache on Losing all your Stored Data!</span>
<span class="caution">Also, when you got error after adding your product - you don't have to worry, the item still encoded. <br/> 
Just hit back button on your browser to go back to this page.</span>
    
</div>

    <!-- Footer Section -->
    <div class="footer__container">
        <div class="footer__links">
            <div class="footer__link--wrapper">
                <div class="footer__link--items">
                    <h2>About Us</h2>
                    <a href="/">How it works</a>
                    <a href="/">Testimonials</a>
                    <a href="/">Careers</a>
                    <a href="/">Investments</a>
                    <a href="/">Terms of Services</a>
                </div>
                <div class="footer__link--items">
                    <h2>Contact Us</h2>
                    <a href="/">Contact</a>
                    <a href="/">Support</a>
                    <a href="/">Destinations</a>
                    <a href="/">Sponsorship</a>
                </div>
            </div>
            <div class="footer__link--wrapper">
                <div class="footer__link--items">
                    <h2>Videos</h2>
                    <a href="/">Submit Video</a>
                    <a href="/">Ambassadors</a>
                    <a href="/">Agency</a>
                    <a href="/">Influencers</a>
                </div>
                <div class="footer__link--items">
                    <h2>Social Media</h2>
                    <a href="https://www.facebook.com/jiffgals?mibextid=ZbWKwL" target="_blank">Facebook</a>
                    <a href="https://instagram.com/jiffengales" target="_blank">Instagram</a>
                    <a href="https://www.tiktok.com/@onekyears?_t=8hnBQNiJ9ZR&_r=1" target="_blank">Tiktok</a>
                    <a href="https://x.com/jiffen_gales?t=D-Npc6IDKX_j6boncPATaA&s=09" target="_blank">Twitter</a>
                    <a href="https://youtube.com/@Prixane?si=cnrrqIbMjQKHE0u3" target="_blank">YouTube</a>
                </div>
            </div>
        </div>
        <div class="social__media">
            <div class="social__media--wrap">
                <div class="footer__logo">
                    <a href="https://codepen.io/jiffen/full/vYbzvoY" target="_blank" id="footer__logo">
                        <!-- This is the Gear logo attached in navigation above -->
                        <svg height="50px" width="50px" 
                        version="1.1" 
                        id="Layer_1" 
                        xmlns="http://www.w3.org/2000/svg" 
                        xmlns:xlink="http://www.w3.org/1999/xlink" 
                        viewBox="0 0 512 512" 
                        xml:space="preserve" 
                        fill="#000000">
                        <g id="SVGRepo_bgCarrier" 
                        stroke-width="0"></g>
                        <g id="SVGRepo_tracerCarrier" 
                        stroke-linecap="round" 
                        stroke-linejoin="round"></g>
                        <g id="SVGRepo_iconCarrier"> 
                        <g> 
                            <path style="fill:#ea672e;" 
                            d="M351.104,221.877v-79.494h-36.712c-2.775-9.353-6.495-18.298-11.066-26.717l25.959-25.959 l-56.211-56.21l-25.959,25.959c-8.418-4.571-17.365-8.291-26.717-11.066V11.678h-79.494V48.39 c-9.353,2.775-18.298,6.496-26.717,11.066L88.229,33.497L32.018,89.708l25.959,25.959c-4.571,8.418-8.291,17.365-11.066,26.717 H10.199v79.494h36.712c2.775,9.353,6.495,18.298,11.066,26.717l-25.959,25.959l56.211,56.21l25.959-25.959 c8.418,4.571,17.365,8.291,26.717,11.066v36.712h79.494V315.87c9.353-2.775,18.298-6.496,26.717-11.066l25.959,25.959l56.211-56.21 l-25.959-25.959c4.571-8.418,8.291-17.365,11.066-26.717H351.104z M180.651,245.954c-35.249,0-63.825-28.575-63.825-63.825 s28.575-63.825,63.825-63.825s63.825,28.575,63.825,63.825S215.901,245.954,180.651,245.954z"></path> 
                            <path style="fill:#ea672e;" 
                            d="M484.685,457.985l17.116-42.866l-19.797-7.904c0.517-5.641,0.438-11.266-0.215-16.79l19.588-8.409 l-18.208-42.413l-19.588,8.409c-3.555-4.278-7.579-8.209-12.024-11.72l7.904-19.797l-42.866-17.116l-7.904,19.797 c-5.641-0.517-11.266-0.438-16.79,0.215l-8.409-19.588l-42.413,18.208l8.409,19.588c-4.278,3.555-8.209,7.579-11.72,12.024 l-19.797-7.904l-17.116,42.866l19.797,7.904c-0.517,5.641-0.438,11.266,0.215,16.79l-19.588,8.409l18.208,42.413l19.588-8.409 c3.555,4.278,7.579,8.209,12.024,11.72l-7.904,19.797l42.866,17.116l7.904-19.797c5.641,0.517,11.266,0.438,16.79-0.215 l8.409,19.588l42.413-18.208l-8.409-19.588c4.278-3.555,8.209-7.579,11.72-12.024L484.685,457.985z M387.586,434.267 c-19.008-7.589-28.264-29.151-20.675-48.159c7.589-19.008,29.151-28.264,48.159-20.675c19.008,7.589,28.264,29.151,20.675,48.159 C428.155,432.6,406.593,441.857,387.586,434.267z"></path> 
                        </g> 
                            <path d="M339.485,274.553c0-2.705-1.075-5.3-2.987-7.212l-20.721-20.721c2.258-4.73,4.271-9.589,6.023-14.544h29.306 c5.633,0,10.199-4.566,10.199-10.199v-79.494c0-5.633-4.566-10.199-10.199-10.199H321.8c-1.752-4.954-3.765-9.814-6.023-14.544 l20.722-20.721c3.983-3.983,3.983-10.441,0-14.425l-56.211-56.21c-3.983-3.982-10.441-3.982-14.424,0l-20.722,20.721 c-4.731-2.258-9.589-4.27-14.544-6.023V11.678c0-5.633-4.566-10.199-10.199-10.199h-79.494c-5.633,0-10.199,4.566-10.199,10.199 v29.305c-4.953,1.751-9.813,3.764-14.544,6.023L95.44,26.285c-3.983-3.983-10.441-3.983-14.424,0l-56.21,56.21 c-3.983,3.983-3.983,10.441,0,14.425l20.721,20.721c-2.258,4.73-4.271,9.59-6.023,14.544H10.199C4.566,132.184,0,136.751,0,142.384 v79.494c0,5.633,4.566,10.199,10.199,10.199h29.305c1.752,4.954,3.764,9.814,6.023,14.544l-20.721,20.721 c-1.912,1.912-2.987,4.507-2.987,7.212s1.075,5.299,2.987,7.212l56.21,56.211c1.912,1.912,4.507,2.987,7.212,2.987 c2.705,0,5.299-1.075,7.212-2.987l20.721-20.722c4.731,2.258,9.59,4.271,14.544,6.023v29.305c0,5.633,4.566,10.199,10.199,10.199 h79.494c5.633,0,10.199-4.566,10.199-10.199v-29.305c4.954-1.752,9.813-3.764,14.544-6.023l20.721,20.722 c1.912,1.912,4.507,2.987,7.212,2.987s5.3-1.075,7.212-2.987l56.21-56.211C338.41,279.852,339.485,277.258,339.485,274.553z M273.074,316.34l-18.747-18.747c-3.194-3.193-8.109-3.907-12.079-1.751c-7.834,4.253-16.162,7.702-24.752,10.251 c-4.329,1.285-7.298,5.263-7.298,9.778v26.513h-59.095v-26.513c0-4.515-2.969-8.493-7.298-9.778 c-8.59-2.549-16.917-5.998-24.752-10.251c-3.97-2.155-8.882-1.443-12.079,1.751L88.227,316.34l-41.786-41.787l18.747-18.746 c3.194-3.194,3.907-8.109,1.751-12.079c-4.253-7.834-7.702-16.162-10.251-24.751c-1.284-4.329-5.263-7.298-9.778-7.298H20.398 v-59.095h26.513c4.515,0,8.494-2.969,9.778-7.299c2.549-8.59,5.998-16.917,10.251-24.751c2.155-3.97,1.443-8.885-1.751-12.079 L46.442,89.708l41.786-41.786l18.747,18.747c3.194,3.193,8.109,3.907,12.078,1.751c7.835-4.253,16.163-7.702,24.752-10.251 c4.329-1.285,7.298-5.263,7.298-9.778V21.877h59.095V48.39c0,4.515,2.969,8.493,7.298,9.778c8.591,2.55,16.918,5.998,24.752,10.251 c3.972,2.156,8.885,1.443,12.078-1.751l18.747-18.747l41.786,41.786l-18.747,18.747c-3.194,3.194-3.906,8.109-1.751,12.079 c4.252,7.832,7.701,16.159,10.251,24.751c1.285,4.329,5.263,7.298,9.778,7.298h26.513v59.095H314.39 c-4.515,0-8.493,2.969-9.778,7.298c-2.55,8.592-5.999,16.92-10.251,24.752c-2.155,3.971-1.443,8.885,1.751,12.079l18.747,18.746 L273.074,316.34z"></path> 
                            <path d="M254.675,182.13c0-40.817-33.207-74.024-74.024-74.024c-40.816,0-74.023,33.207-74.023,74.024s33.207,74.024,74.023,74.024 C221.469,256.154,254.675,222.947,254.675,182.13z M127.027,182.13c0-29.569,24.056-53.625,53.624-53.625 s53.625,24.056,53.625,53.625s-24.056,53.625-53.625,53.625S127.027,211.698,127.027,182.13z"></path> 
                            <path d="M271.987,203.528c-5.315-1.875-11.138,0.914-13.011,6.226c-11.687,33.139-43.164,55.404-78.325,55.404 c-5.633,0-10.199,4.566-10.199,10.199s4.566,10.199,10.199,10.199c43.795,0,83.002-27.736,97.561-69.017 C280.086,211.227,277.299,205.401,271.987,203.528z"></path> 
                            <path d="M273.878,171.931c-5.633,0-10.199,4.566-10.199,10.199c0,1.32-0.031,2.651-0.092,3.953 c-0.263,5.627,4.085,10.402,9.711,10.665c0.163,0.007,0.324,0.011,0.486,0.011c5.414,0,9.924-4.258,10.18-9.722 c0.075-1.62,0.114-3.271,0.114-4.908C284.077,176.497,279.511,171.931,273.878,171.931z"></path> 
                            <path d="M418.852,355.962c-24.202-9.664-51.75,2.165-61.412,26.365c-9.663,24.201,2.164,51.75,26.364,61.412l0,0 c5.73,2.288,11.643,3.371,17.466,3.371c18.773,0,36.571-11.264,43.946-29.735C454.879,393.175,443.052,365.625,418.852,355.962z M426.273,409.811c-2.66,6.663-7.757,11.891-14.348,14.722c-6.592,2.83-13.892,2.924-20.556,0.263l0,0 c-13.755-5.492-20.477-21.15-14.985-34.905s21.152-20.476,34.905-14.985C425.043,380.398,431.765,396.056,426.273,409.811z"></path> 
                            <path d="M511.173,411.095c-1.067-2.486-3.078-4.446-5.59-5.448l-13.045-5.208c0.008-1.171-0.007-2.341-0.044-3.51l12.906-5.541 c2.486-1.067,4.446-3.078,5.448-5.59c1.003-2.512,0.967-5.32-0.1-7.805l-18.209-42.413c-2.221-5.175-8.22-7.572-13.396-5.348 l-12.906,5.541c-0.822-0.832-1.659-1.649-2.514-2.45l5.209-13.045c2.089-5.231-0.459-11.165-5.69-13.254l-42.866-17.116 c-5.229-2.087-11.165,0.459-13.254,5.69l-5.209,13.045c-1.167-0.009-2.34,0.007-3.51,0.044l-5.54-12.908 c-1.067-2.486-3.078-4.446-5.59-5.448c-2.511-1.003-5.32-0.968-7.805,0.1l-42.413,18.209c-5.176,2.222-7.571,8.22-5.348,13.396 l5.541,12.906c-0.832,0.822-1.649,1.66-2.45,2.514l-13.044-5.209c-2.512-1.003-5.32-0.968-7.805,0.1 c-2.486,1.067-4.446,3.078-5.448,5.589L291.384,380.8c-2.089,5.231,0.459,11.165,5.69,13.254l13.045,5.209 c-0.008,1.17,0.007,2.341,0.044,3.51l-12.906,5.541c-2.486,1.067-4.446,3.078-5.448,5.59c-1.003,2.512-0.967,5.32,0.1,7.805 l18.209,42.413c1.067,2.486,3.078,4.446,5.59,5.448c2.511,1.003,5.32,0.968,7.805-0.1l12.906-5.541 c0.822,0.832,1.659,1.649,2.514,2.45l-5.209,13.045c-2.089,5.231,0.459,11.165,5.69,13.254l42.866,17.116 c1.215,0.485,2.499,0.727,3.782,0.727c1.37,0,2.741-0.276,4.024-0.827c2.486-1.067,4.446-3.078,5.448-5.59l5.208-13.044 c1.169,0.005,2.342-0.007,3.51-0.045l5.541,12.906c2.221,5.176,8.217,7.57,13.396,5.348l42.413-18.209 c2.486-1.067,4.446-3.078,5.448-5.59c1.003-2.512,0.967-5.32-0.1-7.805l-5.541-12.906c0.832-0.822,1.649-1.659,2.45-2.514 l13.045,5.209c5.229,2.087,11.165-0.459,13.254-5.69l17.116-42.866C512.276,416.388,512.24,413.58,511.173,411.095z M478.995,444.73 l-10.325-4.122c-4.194-1.675-8.989-0.393-11.786,3.152c-3.039,3.849-6.484,7.383-10.236,10.502 c-3.474,2.887-4.634,7.716-2.852,11.867l4.386,10.216l-23.67,10.161l-4.386-10.216c-1.782-4.15-6.079-6.633-10.567-6.105 c-4.845,0.572-9.779,0.635-14.663,0.187c-4.497-0.41-8.729,2.182-10.403,6.375l-4.123,10.325l-23.922-9.552l4.122-10.325 c1.675-4.193,0.393-8.989-3.152-11.786c-3.849-3.039-7.383-6.484-10.502-10.236c-2.887-3.474-7.716-4.635-11.867-2.852 l-10.216,4.386l-10.161-23.67l10.216-4.386c4.151-1.782,6.636-6.082,6.105-10.568c-0.572-4.844-0.635-9.777-0.188-14.662 c0.412-4.496-2.182-8.728-6.374-10.403l-10.325-4.123l9.552-23.922l10.325,4.123c4.194,1.674,8.989,0.392,11.787-3.152 c3.04-3.85,6.484-7.384,10.235-10.501c3.474-2.887,4.635-7.716,2.853-11.867l-4.386-10.216l23.67-10.161l4.386,10.216 c1.782,4.15,6.078,6.633,10.567,6.105c4.847-0.572,9.781-0.634,14.662-0.188c4.499,0.411,8.729-2.181,10.404-6.375l4.123-10.326 l23.922,9.552l-4.123,10.326c-1.675,4.193-0.392,8.989,3.152,11.786c3.85,3.04,7.383,6.484,10.501,10.235 c2.888,3.474,7.716,4.635,11.867,2.853l10.216-4.386l10.161,23.67l-10.216,4.386c-4.151,1.782-6.635,6.082-6.105,10.568 c0.572,4.845,0.635,9.777,0.188,14.661c-0.413,4.497,2.181,8.729,6.375,10.404l10.325,4.123L478.995,444.73z"></path> 
                        </g>
                        </svg> GT</a>
                </div>
                <p class="website__rights"> &copy; GT 2023. All rights reserved</p>
                <div class="social__icons">
                    <a href="/" class="social__icon--link">icons here</a>
                </div>
            </div>
        </div>
    </div>

    <script src="app.js"></script>
    <script src="inventory/app.js"></script>
    <script>
    const menu = document.querySelector('#mobile-menu')
const menuLinks = document.querySelector('.navbar__menu')

menu.addEventListener('click', function() {
    menu.classList.toggle('is-active')
    menuLinks.classList.toggle('active');
});

function addProduct() {
    var name = document.getElementById('productName').value;
    var quantity = prompt("Please enter Quantity", "");
    var price = prompt("Please enter the price", "");
    if (price === null || price === "") {
      return;
    }
    var table = document.getElementById('inventoryTable');
    var row = table.insertRow(-1);
    var cell1 = row.insertCell(0);
    var cell2 = row.insertCell(1);
    var cell3 = row.insertCell(2);
    var cell4 = row.insertCell(3);
    var cell5 = row.insertCell(4);
    cell1.innerHTML = name;
    cell2.innerHTML = '<span class="quantity">' + quantity + '</span>';
    cell3.innerHTML = price;
    cell4.innerHTML = '<button class="remove" onclick="removeProduct(this)">Remove</button>';
    document.getElementById('productName').value = '';
    document.getElementById('productQuantity').value = '';
    var inventory = JSON.parse(localStorage.getItem('inventory')) || [];
    inventory.push({ name: name, quantity: quantity, price: price });
    localStorage.setItem('inventory', JSON.stringify(inventory));
    loadInventory();
  }

  document.addEventListener('DOMContentLoaded', function() {
    var inventory = JSON.parse(localStorage.getItem('inventory')) || [];
    var table = document.getElementById('inventoryTable');
    table.innerHTML = '<tr><th>Product Name</th><th>Quantity</th><th>Price<th>Actions</th></tr>';
    inventory.forEach(function(item) {
      addProductToTable(item.name, item.quantity, item.price);
    });
    loadInventory();
  });
  
  function removeProduct(btn) {
    var row = btn.parentNode.parentNode;
    var name = row.cells[0].innerHTML;
    var price = row.cells[2].innerHTML;
    var inventory = JSON.parse(localStorage.getItem('inventory'));
    var index = inventory.findIndex(function(item) {
      return item.name === name, item.price === price;
    });
    inventory.splice(index, 1);
    localStorage.setItem('inventory', JSON.stringify(inventory));
    row.parentNode.removeChild(row);
  }
  
  function changeQuantity(button, amount) {
    var row = button.parentNode.parentNode;
    var quantity = row.querySelector('.quantity');
    quantity.textContent = Number(quantity.textContent) + amount;
    var name = row.cells[0].innerHTML;
    var price = row.cell[2].innerHTML;
    var inventory = JSON.parse(localStorage.getItem('inventory'));
    var index = inventory.findIndex(function(item) {
      return item.name === name, item.price === price;
    });
    inventory[index].quantity = Number(inventory[index].quantity) + amount;
    localStorage.setItem('inventory', JSON.stringify(inventory));
  }
  
  function loadInventory() {
    var inventory = JSON.parse(localStorage.getItem('inventory')) || [];
    var table = document.getElementById('inventoryTable');
    table.innerHTML = '<tr><th>Product Name</th><th>Quantity</th><th>Price</th><th>Actions</th></tr>';
    inventory.forEach(function(item) {
      addProductToTable(item.name, item.quantity, item.price);
    });
    document.querySelectorAll('.quantity').forEach(function(input) {
      input.addEventListener('change', function() {
        var name = this.parentNode.parentNode.cells[0].innerHTML;
        var price = this.parentNode.parentNode.cells[2].innerHTML;
        var inventory = JSON.parse(localStorage.getItem('inventory'));
        var index = inventory.findIndex(function(item) {
          return item.name === name, item.price === price;
        });
        inventory[index].quantity = this.value;
        localStorage.setItem('inventory', JSON.stringify(inventory));
      });
    });
  }
  
  function addProductToTable(name, quantity, price) {
      var table = document.getElementById('inventoryTable');
      var row = table.insertRow(-1);
      var cell1 = row.insertCell(0);
      var cell2 = row.insertCell(1);
      var cell3 = row.insertCell(2);
      var cell4 = row.insertCell(3);
      cell1.innerHTML = name;
      cell2.innerHTML = '<input type="number" class="quantity" value="' + quantity + '">';
      cell3.innerHTML = price;
      cell4.innerHTML = '<button class="remove" onclick="removeProduct(this)">Remove</button>';
    }
  
  function searchTable() {
    var input, filter, table, tr, td, i, txtValue;
    input = document.getElementById("searchInput");
    filter = input.value.toUpperCase();
    table = document.getElementById("inventoryTable");
    tr = table.getElementsByTagName("tr");
    for (i = 0; i < tr.length; i++) {
      td = tr[i].getElementsByTagName("td")[0];
      if (td) {
        txtValue = td.textContent || td.innerText;
              if (txtValue.toUpperCase().indexOf(filter) > -1) {
          tr[i].style.display = "";
        } else {
          tr[i].style.display = "none";
        }
      }
    }
  }
    </script>
</body>
</html>