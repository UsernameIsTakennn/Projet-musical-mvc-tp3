{{ include('layouts/header.php', {title: 'Inscription'}) }}

<div class="container">

    <form method="post">

        <h2>Inscription</h2>

        <label>Nom
            <input
                type="text"
                name="name"
                value="{{ user.name }}"
                required>
        </label>
        {% if errors.name is defined %}
        <span class="error">{{ errors.name }}</span>
        {% endif %}

        <label>Nom d'utilisateur
            <input
                type="text"
                name="username"
                value="{{ user.username }}"
                required>
        </label>
        {% if errors.username is defined %}
        <span class="error">{{ errors.username }}</span>
        {% endif %}

        <label>Courriel
            <input
                type="email"
                name="email"
                placeholder="votre@courriel.com"
                value="{{ user.email }}"
                required>
        </label>
        {% if errors.email is defined %}
        <span class="error">{{ errors.email }}</span>
        {% endif %}

        <label>Mot de passe (8 caractères minimum)
            <input
                type="password"
                name="password"
                required>
        </label>
        {% if errors.password is defined %}
        <span class="error">{{ errors.password }}</span>
        {% endif %}

        <input type="submit" class="btn" value="Créer mon compte">

        <p>Déjà inscrit ? <a href="{{ base }}/login">Connexion</a></p>

    </form>

</div>

{{ include('layouts/footer.php') }}