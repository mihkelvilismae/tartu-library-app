<div id="sidebar">
    <span>
        <table class="responstable sidebar-table">
            <!--            <tr>-->
            <!--                <td>Kasutajad</td>-->
            <!--            </tr>-->
            <tr>
                <td><a href="<?=base_url("Koolid")?>" <?php if ($active==="Koolid") {echo "class=\"active-class\"";} ?>>Koolid</a></td>
            </tr>
            <tr>
                <td><a href="<?=base_url("Klassid")?>" <?php if ($active==="Klassid") {echo "class=\"active-class\"";} ?>>Klassid</a></td>
            </tr>
            <tr>
                <td><a href="<?=base_url("Nimekiri")?>" <?php if ($active==="Nimekiri") {echo "class=\"active-class\"";} ?>>Nimekirjad</a></td>
            </tr>
        </table>
        </span>
</div>