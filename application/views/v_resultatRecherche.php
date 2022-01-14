            <h5 class="pt-5">Résultat de la recherche</h5>
            <table class="table table-striped"  style="width:70%" style='text-align : center'>
                <caption>les conférences trouvées</caption>
                <thead>
                    <tr style='background-color: #2E86C1; color: white'>
                        <th scope="col">Thème</th>
                        <th scope="col">Horaire</th>
                        <th scope="col">Place dispo</th>
                        <th scope="col">Date</th>
                        <th scope="col">Animateur</th>
                        <th scope="col">Salle</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        foreach ($resultR as $rConf) {
                            echo "<tr>";
                            echo "  <td> $rConf->theme </td>";
                            echo "  <td> $rConf->horaire </td>";
                            echo "  <td> $rConf->nbPlace </td>";
                            echo "  <td> $rConf->dateP </td>";
                            echo "  <td> $rConf->nom </td>";
                            echo "  <td> $rConf->nomSalle </td>";
                            //bouton ajouter une conférence
                            echo " <td>";
                            //s'inscrire au conférence
                                echo form_open('ControleurConference/inscriptionConf');
                                echo form_input(array(
                                    'type'  => 'hidden',
                                    'name'  => 'idConf',
                                    'id'    => 'idConf', 
                                    'value' => $rConf->id,
                                ));
                                echo form_input(array(
                                    'type'  => 'hidden',
                                    'name'  => 'codeC',
                                    'id'    => 'codeC',
                                    'value' => $rConf->CodeC,
                            ));
                            echo form_submit(array(
                                    'id' => 'inscription',
                                    'placeholder'=>'Ajouter',
                                    'class' => 'btn btn-outline-primary',
                                    'value' => 'Ajouter',
                            ));
                            echo form_close();
                            echo "  </td>";
                            echo "</tr>";
                        }
                    ?>
                </tbody>
            </table>