var sidebarIsOpen = true;
        togglebtn.addEventListener('click', (event) => {
            event.preventDefault();
            if (sidebarIsOpen) {
                dashboardsidebar.style.width = '10%';
                dashboardmaincontainer.style.width = '90%';
                dashboardlogo.style.fontSize = '60px';
    
                menuicons = document.getElementsByClassName('menuText');
                for (var i = 0; i < menuicons.length; i++) {
                    menuicons[i].style.display = 'none'; // Hide menu icons
                }
                sidebarIsOpen = false;
            } else {
                dashboardsidebar.style.width = '20%';
                dashboardmaincontainer.style.width = '100%';
                dashboardlogo.style.fontSize = '80px';
    
                menuicons = document.getElementsByClassName('menuText');
                for (var i = 0; i < menuicons.length; i++) {
                    menuicons[i].style.display = 'block'; // Show menu icons
                }
                sidebarIsOpen = true;
            }
        });