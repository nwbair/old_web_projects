<br /><br />

<form action="<?=base_url();?>index.php/users/insertNewUser" method="post">
    <ul style="list-style:none;">
        <li>
            <label for="name">Full Name&nbsp;</label>
            <span style="width:20%"><input type="text" name="fullname" id="name" value=""/></span>
        </li>
        <li>
            <label for="email">Email&nbsp;</label>
            <span ><input type="text" name="email" id="email" value=""/></span>
        </li>
        <li>
            <label for="contact">Username&nbsp;</label>
            <span ><input type="text" name="loginid" id="loginid" value=""/></span>
        </li>
        <li>
            <label for="msg">Password&nbsp;</label>
            <span><input type="text" name="password" id="contact" value="newcustomer"/></span>
        </li>
    </ul>
 
    <input type="submit" value="Add User" class="btn small primary" name="sendbutton" style="margin-left:20%;"/>
</form>