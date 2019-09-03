<title> Calendar </title>


  <script src='http://raptor.kent.ac.uk/~lc559/ci/scripts/fullcalendar/vendor/rrule.js'></script>
  <!-- FullCalendar Stylesheet -->
  <link href='http://raptor.kent.ac.uk/~lc559/ci/scripts/fullcalendar/packages/core/main.css' rel='stylesheet' />
  <link href='http://raptor.kent.ac.uk/~lc559/ci/scripts/fullcalendar/packages/daygrid/main.css' rel='stylesheet' />

  <!-- FullCalendar Plugins -->
  <script src='http://raptor.kent.ac.uk/~lc559/ci/scripts/fullcalendar/packages/core/main.js'></script>
  <script src='http://raptor.kent.ac.uk/~lc559/ci/scripts/fullcalendar/packages/daygrid/main.js'></script>

  <script src='http://raptor.kent.ac.uk/~lc559/ci/scripts/fullcalendar/packages/rrule/main.js'></script>


  <script>

    //Plugins used:
    //FullCalendar - https://fullcalendar.io/
    //RRule - https://github.com/jakubroztocil/rrule

    document.addEventListener('DOMContentLoaded', function() { //essentially, 'DOMContentLoaded' is said by the web page once all of the content has been loaded. Once the document has said that, FullCalendar can then be executed.
    var here = document.getElementById('calendar'); //debug
    var calendar = new FullCalendar.Calendar(here, { //store the calendar and its details in the variable. Is what happens here is that FullCalender being stored into the variable calendar.
    //new FullCalendar.Calender creates an object of FullCalendar and states what element in the DOM it's going to be placed under, in this case, the div object called Calendar. The information below is information that states what
    //is going to be making up the calendar.

      plugins: ['dayGrid', 'rrule'], //the plugin section here is now what determines the style in how the calendar will be rendered, in this case it will be the dayGrid, as that's the one we have loaded in here in the script tags above.
      //Rrule is another plugin which is integrated into FullCalendar, this allows for more powerful control over how often you want to run events, for example, FullCalendar only has limited options when it comes to recurring events,
      //Rrule allows for a lot more, such as Daily, Weekly, Monthly and Yearly events.

    events: [

      <?php

        foreach($results as $row) {

          echo"{title: ". "'".$row['amount']." ".$row['description']."'".", "; //this here is the amount and name of the event, in this case, the amount that is due and what it is.
          echo "rrule: {freq:"." '".$row['frequency']."', "; //freq is how often this event will happen, this could be weekly, monthly or yearly in the case of our web app.
          echo "dtstart: "."'".$row['base_date']."'".", "; //dtstart is when the event will start recurring from - in this case, the user inputs a date they want to start from.
          echo "interval: 1"."},"; //interval is how often the event will run, in this example, it's saying once every week. Having 2 would say, hey, do this every other week.
          echo '},';
        }

       ?>
     ]

    });

    calendar.render(); //render the variable calender, in other words, load the calendar onto the webpage. Var Calender is essentially the template from where this will then load.

});

  </script>

  <style>
    input:not([type=submit]){

          border: 2px solid red;
          border-radius: 5px;
          padding: 10px;
   }


       body {
         background-color: #E7E6E6;
         margin: 0;
       }

       .jumbotron {
         height: 15vh;
         background-color: #E84A5F;
         margin: 0;
         color: white;
       }

       .centerme  {
         position: relative;
         top: 50%;
         transform: translateY(-75%);
       }

       .navbar .navbar-center {
         position: absolute;
       }

       .navbar .navbar-collapse {
         text-align: center;
       }

       .text{
         color: white;
       }

       #input {
         text-align: center;
         margin: 0 auto;
       }

       #text {
         width: 40%;
         padding: 0.5em, 0.25em;
       }

       #loginInformation{
         border-radius: 5;
       }

       #message, #selecter, #pieChart {
         text-align: center;
         margin: 0 auto;
       }

       p {
         text-align: center;
         margin: 0 auto;
       }

       .progress {
         text-align: center;
         margin: 0 auto;
       }

  </style>


  <h3 id="message"> What's the plan regarding your new frequent payment? </h3>

  <br>

  <form id = "input" action="http://raptor.kent.ac.uk/~lc559/ci/index.php/Outgoings_controller/addPaymentFrequency" method="post">
    Details:
    <input type="text" name="details" pattern=".{1,}" required placeholder="Phone Bill due"> <!-- cite https://www.w3.org/TR/2009/WD-html5-20090825/forms.html#attr-input-pattern -->
    Amount:
    <input type="number" min="0.01" step="0.01" name="amount" requried placeholder="5.99">
    Date:
    <input type="date" name="day" id="day" value="2019-01-01" required>
    Frequency:
    <select name="frequency">
      <option value="weekly"> Weekly </option>
      <option value="monthly"> Monthly </option>
      <option value="yearly"> Yearly </option>
    </select>

    <input type="submit" class="btn btn-danger">

  </form>

  <br>
  <br>

  <h3 id="message"> Here's a look at your calendar</h3>

  <br>
  <br>

  <div id = "calendar" class="center">



  </div>

<br>
<br>


  <script>

    document.getElementById('day').valueAsDate = new Date(); //cite valueAsDate

  </script>
