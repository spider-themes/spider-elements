function openTab(tabName) {
    // Hide all tabs
    var tabs = document.getElementsByClassName('tab');
    for (var i = 0; i < tabs.length; i++) {
      tabs[i].classList.remove('active');
    }
  
    // Deactivate all tab buttons
    var tabButtons = document.getElementsByClassName('tab-button');
    for (var i = 0; i < tabButtons.length; i++) {
      tabButtons[i].classList.remove('active');
    }
  
    // Show the selected tab
    document.getElementById(tabName).classList.add('active');
  
    // Activate the selected tab button
    var tabButton = document.querySelector('[onclick="openTab(\'' + tabName + '\')"]');
    tabButton.classList.add('active');
  }