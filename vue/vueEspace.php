<main>
    <section>
        <table>
            <caption>
                <?= $Classe->getClasseByID($user['Id_Classe']) ?>
            </caption>
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Passage</th>
                    <th>Date</th>
                    <th>Moyenne</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <?= $user['nom'] ?>
                    </td>
                    <td>
                        <?= $user['prenom'] ?>
                    </td>
                    <td>
                        <?= $user['passage'] == true ? 'oui' : 'non' ?>
                    </td>
                    <td data-date="<?= $user['date_p'] ?>">
                    </td>
                    <td>
                        <?= $Note->getMoyenneEleveByID($user['Id_Utilisateur']) ?>
                    </td>
                </tr>
            </tbody>
        </table>
    </section>
</main>