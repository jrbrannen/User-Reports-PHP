<html>
    <body>
        <div>User Report</div>        
		<a href="<?= $_SERVER['SCRIPT_NAME']; ?>?download=1&<?= $_SERVER["QUERY_STRING"]; ?>">Download Report</a><br><br>			
        <div>
            <form action="<?php echo $_SERVER['SCRIPT_NAME']; ?>" method="GET">
                Filter: 
                <select name="filterColumn">
                    <option value="user_name">User Name</option>
                    <option value="user_level">User Level</option>
                    <option value="user_first_name">First Name</option>
                    <option value="user_last_name">Last Name</option>                    
                </select>
                &nbsp;<input type="text" name="filterText"/>
                &nbsp;<input type="submit" name="btnViewReport" value="View Report"/>
            </form>
        </div>
		<?php if (count($userList) > 0) { ?>
		<div>
            <table border="1">
                <tr>
                    <th>User Name</th>
                    <th>First Name</th>
                    <th>Last Name</th> 
                    <th>User Level</th> 
                </tr>
                <?php foreach ($userList as $userData) { ?>
                    <tr>
                        <td><?php echo $userData['user_name']; ?></td>                
                        <td><?php echo $userData['user_first_name']; ?></td>                
                        <td><?php echo $userData['user_last_name']; ?></td>                
                        <td><?php echo $userData['user_level']; ?></td>                          
                    </tr>
                <?php } ?>                
            </table>
			<a href="<?= $_SERVER['SCRIPT_NAME']; ?>?<?= $nextPageLink; ?>">Next Page</a>			
        </div>
		<?php } ?>
    </body>
</html>