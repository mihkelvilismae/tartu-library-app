<div id="sidebar">
    <span>
        <table class="responstable sidebar-table">
            <?php
            if ($_SESSION['is_admin'] == 1) {
                echo '<tr>';
                if (isset($active) && $active==="Kasutajad") {
                    $class = "class=\"active-class\"";
                } else {
                    $class = "";
                }
                echo '<td><a href="'.base_url("Kasutajad").'" '.$class.'>Kasutajad</a></td>';
                echo '</tr>';
            }
            ?>
            <tr>
                <td><a href="<?=base_url("Koolid")?>" <?php if (isset($active) && $active==="Koolid") {echo "class=\"active-class\"";} ?>>Koolid</a></td>
            </tr>
            <tr>
                <td><a href="<?=base_url("Klassid")?>" <?php if (isset($active) && $active==="Klassid") {echo "class=\"active-class\"";} ?>>Klassid</a></td>
            </tr>
            <tr>
                <td><a href="<?=base_url("Nimekiri")?>" <?php if (isset($active) && $active==="Nimekiri") {echo "class=\"active-class\"";} ?>>Raamatunimekirjad</a></td>
            </tr>
            <tr>
                <td><a href="<?=base_url("Login/logout")?>">Logi välja</a></td>
            </tr>
                </table>
    </span>
</div>