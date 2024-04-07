<main>
    <?php if (!empty($get_classe)) {
        $eleves = $Eleve->getElevesByClasseID($get_classe);?>
    <section>
        <table>
            <caption>
                <?= $Classe->getClasseByID($get_classe) ?>
                <form action="?a=classes" method="post">
                    <input style="display: none" name="id_c" value="<?=$get_classe?>">
                    <input type="submit" value="Supprimer">
                </form>
            </caption>
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Passage</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($eleves as $info_eleve) { ?>
                    <tr>
                        <td>
                            <?= $info_eleve['nom_e'] ?>
                        </td>
                        <td>
                            <?= $info_eleve['prenom_e'] ?>
                        </td>
                        <td>
                            <?= $info_eleve['passage'] != 0 ? 'oui' : 'non' ?>
                        </td>
                        <td data-date="<?=$info_eleve['date_p']?>">
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </section>
    <?php } else {
        $classes = $Classe->getAllClasses() ?>
    <section>
        Choisir une classe :
        <ul>
            <?php foreach ($classes as $classe) { ?>
                <li>
                    <a href="?a=classes&c=<?=$classe['id_c']?>"><?=$classe['nom_c']?></a>
                </li>
            <?php } ?>
        </ul>
    </section>
    <?php } ?>
</main>