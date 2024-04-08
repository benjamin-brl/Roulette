<main>
    <?php
    $classes = $Classe->getAllClasses();
    foreach ($classes as $classe) {
        $eleves = $Eleve->getElevesByClasseID($classe['Id_Classe']) ?>
        <section>
            <table>
                <caption>
                    <?= $Classe->getClasseByID($classe['Id_Classe']) ?>
                </caption>
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Passage</th>
                        <th>Date</th>
                        <th>Moyenne</th>
                        <th>Ajouter note</th>
                        <th>Supprimer</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($eleves as $info_eleve) { ?>
                        <tr>
                            <td>
                                <?= $info_eleve['nom'] ?>
                            </td>
                            <td>
                                <?= $info_eleve['prenom'] ?>
                            </td>
                            <td>
                                <?= $info_eleve['passage'] == true ? 'oui' : 'non' ?>
                            </td>
                            <td data-date="<?=$info_eleve['date_p']?>">
                            </td>
                            <td>
                                <?= $Note->getMoyenneEleveByID($info_eleve['Id_Utilisateur'])?>
                            </td>
                            <td>
                                <a href="<?='?a=notes&c='.$classe['Id_Classe'].'&e='.$info_eleve['Id_Utilisateur']?>">Noter</a>
                            </td>
                            <td>
                                <form action="?a=eleves" method="post">
                                    <input name="id_e" style="display: none" value="<?=$info_eleve['Id_Utilisateur']?>">
                                    <input type="submit" value="Supprimer">
                                </form>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </section>
    <?php } ?>
</main> 