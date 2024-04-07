<main>
    <?php if (!empty($get_classe)) {
        $eleves = $Eleve->getElevesNonPasseByClasseID($get_classe);
        $eleves_tires = $Eleve->getElevesPasseByClasseID($get_classe);
        $absents = $Eleve->getAbsentsByClasseID($get_classe);
        if (!empty($absents)) { ?>
            <section>
                <table>
                    <caption id="<?=$get_classe?>">
                        Absents
                    </caption>
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Prénom</th>
                            <th>Noter</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($absents as $info_absent) { ?>
                            <tr>
                                <td>
                                    <?= $info_absent['nom_e'] ?>
                                </td>
                                <td>
                                    <?= $info_absent['prenom_e'] ?>
                                </td>
                                <td>
                                    <a href="?a=notes&c=<?=$get_classe?>&e=<?=$info_absent['id_e']?>">Noter</a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </section>
        <?php } ?>
    <section>
        <table>
            <caption id="<?=$get_classe?>">
                <?= $Classe->getClasseByID($get_classe) ?>
            </caption>
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Prénom</th>
                </tr>
            </thead>
            <tbody id="tab_tirage">
                <?php
                foreach ($eleves as $info_eleve) { ?>
                    <tr>
                        <td id="<?=$info_eleve['id_e']?>">
                            <?= $info_eleve['nom_e'] ?>
                        </td>
                        <td id="<?=$info_eleve['id_e']?>">
                            <?= $info_eleve['prenom_e'] ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <button id="tirage">Tirer au sort</button>
        <div id="eleve_tire"></div>
    </section>
    <section>
        <table>
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Prénom</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($eleves_tires as $info_eleve_tire) { ?>
                    <tr>
                        <td>
                            <?= $info_eleve_tire['nom_e'] ?>
                        </td>
                        <td>
                            <?= $info_eleve_tire['prenom_e'] ?>
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
                    <a href="?a=tirage&c=<?=$classe['id_c']?>"><?=$classe['nom_c']?></a>
                </li>
            <?php } ?>
        </ul>
    </section>
    <?php } ?>
</main>