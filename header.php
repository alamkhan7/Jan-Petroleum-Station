<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/bootstrap-datetimepicker.min.css">
<link href="css/jquery-ui.min.css" rel="stylesheet">
<link href="css/jquery-ui.structure.min.css" rel="stylesheet">
<link href="css/jquery-ui.theme.min.css" rel="stylesheet">
<!-- Custome CSS style -->
<link rel="stylesheet" href="css/navbar-fixed-side.css">
<!-- fontawesome -->
<!-- <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous"> -->

<title>::Jan Station</title>

<style>
    .marquee {
      width: 100%;
      margin: 0 auto;
      white-space: nowrap;
      overflow: hidden;
      box-sizing: border-box;
      background-color: #FFF;
    }
    .marquee span {
      display: inline-block;
      padding-left: 100%;  /* show the marquee just outside the paragraph */
      animation: marquee 15s linear infinite;
      text-shadow:1px 1px 1px rgba(95,255,89,1);
      font-weight:bold;
      color:#357D1B;
      letter-spacing:3pt;
      word-spacing:0pt;
      font-size:1.5em;
      text-align:center;
      font-family:times new roman, times, serif;
      line-height:1;
    }
    .marquee span:hover {
      animation-play-state: paused;
    }
    /* Make it move */
    @keyframes marquee {
      0%   { transform: translate(0, 0); }
      100% { transform: translate(-100%, 0); }
    }

    .navbar-nav{
      background: #222;
    }
    .link-1 {
      transition: 0.4s;
      color: #ffffff;
      text-decoration: none;
    }
    .link-1:hover {
      background-color: #ffffff;
      color: #EEA200;
      padding: 30px 20px;
      font-weight: bold;
    }
    .jan:hover{
        font-size: 1.5em;
    }
  </style>