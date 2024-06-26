<main>
    <?php if (!empty($get_classe)) {
        $eleves = $Eleve->getElevesByClasseID($get_classe);
        ?>
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
                    <a href="?a=classes&c=<?=$classe['Id_Classe']?>"><?=$classe['nom']?></a>
                </li>
            <?php } ?>
        </ul>
    </section>
    <?php } ?>
</main>