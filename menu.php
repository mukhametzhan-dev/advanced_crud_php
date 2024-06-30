<div class="button-bar">
        <button id="add" class="button" onclick="location.href='addbilling.php'">Add</button>
        <button id="delete" class="button" onclick="location.href='delete_billing.php'">Delete</button>
        <button id="update" class="button" onclick="location.href='update_billing.php'">Update</button>
        <button id="view" class="button" onclick="location.href='view_billing.php'">View</button>
        <button id="home" class="button" onclick="location.href='index.php'">Home</button>
    </div>

    <style> 
      .button-bar {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-bottom: 20px;
        }
        #add {
            background-color: #4CAF50;
        }

        #delete {
            background-color: #f44336; 
    
        }

        #home {
            background-color: #008CBA; 
        }
        #update {
            background-color: #008CBA;
        }
        .button {
            width: 150px;
            height: 50px;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            color: white;
        }
        #view
        {
            background-color: #008CBA;
        }
        #view:hover, #add:hover, #delete:hover, #update:hover, #home:hover
        {
            /* background-color: #008CBA; */
            box-shadow: 0 0 5px #ff0000;
        }</style>