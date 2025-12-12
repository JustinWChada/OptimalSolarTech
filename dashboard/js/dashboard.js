$(document).ready(function () {

  // setInterval(function () {
  //   $("#emergencyMessages").toggleClass("active");
  // }, 2000);

  $("#sidebarToggle").click(function () {
    $(".sidebar").toggleClass("open");
  });

  $(document).click(function (event) {
    if (!$(event.target).closest('.sidebar, #sidebarToggle').length) {
      $(".sidebar").removeClass("open");
    }
  });

});

function checkCookie() {
  let user_id = returnCookieValue('user_id')
  let user_name = returnCookieValue('user_name')
  let session_id = returnCookieValue('session_id')

  if (user_id != null && user_name != null && session_id != null) {
    verifySession();
  } else {
    window.location.href = 'session_destroy.php';
  }
}


function verifySession(){
  
  let user_id = returnCookieValue('user_id')
  let user_name = returnCookieValue('user_name')
  let session_id = returnCookieValue('session_id')

  $.ajax({
    type: 'POST',
    url: 'verify.php',
    data: {cookie_session_id: session_id},
    success: function (response) {
      if (response.success) {
        console.log('Session destroyed successfully');
      } //else {
      //   console.log('Failed to destroy session (Session is valid!)');
      // }
    }
  });
}

setInterval(function () {
  checkCookie();
  returnEmergenciesCount();
}, 10000);

//rerwite this:
// if (!checkCookie()) {
//   window.location.href = 'session_destroy.php';
// }

function returnCookieValue(val){
  const cookieValues = document.cookie.split(';').reduce((obj, item) => {
  const [key, value] = item.trim().split('=');
  obj[key] = value;
  return obj;
}, {});

 return(cookieValues[val]) ? cookieValues[val] : cookieValues.val;

}

function returnEmergenciesCount(){
  let emergencies = 0;
  
  $.ajax({
    type: 'POST',
    url: 'emergencies/query_emergencies.php',
    data: {action: 'count'},
    success: function (response) {
      emergencies = JSON.parse(response).count;
      displayEmergenciesCount(emergencies);
    }
  });

}

function displayEmergenciesCount(emergencies){
  document.getElementById('emergencyMessages').innerHTML = "Emergencies (" + emergencies + ")";
}

returnEmergenciesCount();