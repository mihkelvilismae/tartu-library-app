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
                <td><a href="<?=base_url("Raamatud")?>" <?php if (isset($active) && $active==="Raamatud") {echo "class=\"active-class\"";} ?>>Raamatud</a></td>
            </tr>
            <tr>
                <td><a href="<?=base_url("Märksõnad")?>" <?php if (isset($active) && $active==="Märksõnad") {echo "class=\"active-class\"";} ?>>Märksõnad</a></td>
            </tr>
            <tr>
                <td><a href="<?=base_url("Autorid")?>" <?php if (isset($active) && $active==="Autorid") {echo "class=\"active-class\"";} ?>>Autorid</a></td>
            </tr>
            <tr>
                <td><a href="<?=base_url("Zanrid")?>" <?php if (isset($active) && $active==="Zanrid") {echo "class=\"active-class\"";} ?>>Zanrid</a></td>
            </tr>
            <tr>
                <td><a href="<?=base_url("Login/logout")?>">Logi välja</a></td>
            </tr>
                </table>
    </span>
</div>