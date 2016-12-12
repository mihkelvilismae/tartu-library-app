            <div id="row">
                <div class="col-md-2">
                    <table class="table table-condensed">
                        <tbody>
                        <?php
                        if ($_SESSION['is_admin'] == 1) {
                            echo '<tr><td><a href="'.base_url("Kasutajad").'">Kasutajad</a></td></tr>';
                        }
                        ?>
                        <tr>
                            <td>
                                <a href="<?=base_url("Koolid")?>">Koolid</a>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <a href="<?=base_url("Klassid")?>">Klassid</a>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <a href="<?=base_url("Nimekiri")?>">Raamatunimekirjad</a>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <a href="<?=base_url("Raamatud")?>">Raamatud</a>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <a href="<?=base_url("Märksõnad")?>">Märksõnad</a>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <a href="<?=base_url("Autorid")?>">Autorid</a>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <a href="<?=base_url("Zanrid")?>">Zanrid</a>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <a href="<?=base_url("Login/logout")?>">Logi välja</a>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
