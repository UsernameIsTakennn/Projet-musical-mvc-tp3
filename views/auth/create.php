{{ include('layouts/header.php', {title: 'Connexion'}) }}

<div class="container">
    <form action="{{ base }}/login" method="post">
        {% if errors is defined and errors %}
        <div class="error">
            <ul>
                {% for error in errors %}
                <li>{{ error }}</li>
                {% endfor %}
            </ul>
        </div>
        {% endif %}

        <h2>Connexion</h2>

        <label for="username">
            Nom d'utilisateur
            <input
                type="text"
                id="username"
                name="username"
                value="{{ user.username }}"
                required>
        </label>

        <label for="password">
            Mot de passe
            <input
                type="password"
                id="password"
                name="password"
                required>
        </label>

        <input type="submit" class="btn" value="Se connecter">
    </form>
</div>

{{ include('layouts/footer.php') }}