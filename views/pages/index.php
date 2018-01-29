<section class="container">
    <h2>Create shorter links:</h2>

    <form method="POST">
        <label class="text-dark">Your sweeeeeet URL:</label>
        <input type="text" name="url" class="form-control" placeholder="Enter your URL here"
               value="<?= (isset($url) ? $url : '') ?>"/>
        <div class="text-danger mar50"><?= (isset($message) ? $message : '') ?></div>
        <input type="submit" value="Shorten URL" class="btn btn-success">
    </form>

    <hr />
    <h5>No tracking. No bullshit. No nothing! Just reliable URL shortening service.</h5>

</section>
