<main>
    <section>
        <form action="<?= $_SERVER['REQUEST_URI']?>" method="POST">
            <label for="mail"> Votre mail :</label>
            <input id="mail" name="mail" type="mail" placeholder="test@test.test" />
            <label for="psw"> Votre mote de passe :</label>
            <input id="psw" name="psw" type="password" placeholder="Ex4mple.&" />
            <input type="submit" value="Se connecter"/>
        </form>
    </section>
</main>