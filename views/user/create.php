{{ include('layouts/header.php', {title: 'Nouvel utilisateur'}) }}

<div class="container">
    <form action="{{ base }}/user/create" method="post">
        <h2>Nouvel utilisateur</h2>

        {% if errors is defined and errors %}
        <ul class="errors">
            {% for error in errors %}
            <li>{{ error }}</li>
            {% endfor %}
        </ul>
        {% endif %}

        <label for="name">
            Nom
            <input
                type="text"
                id="name"
                name="name"
                value="{{ user.name }}"
                required>
        </label>

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

        <label for="email">
            Adresse courriel
            <input
                type="email"
                id="email"
                name="email"
                value="{{ user.email }}"
                required>
        </label>

        <label for="privilege_id">
            Privilège
            <select id="privilege_id" name="privilege_id" required>
                <option value="">Sélectionner un privilège</option>

                {% for privilege in privileges %}
                <option
                    value="{{ privilege.id }}"
                    {% if privilege.id == user.privilege_id %}selected{% endif %}>
                    {{ privilege.privilege }}
                </option>
                {% endfor %}
            </select>
        </label>

        <input type="submit" value="Enregistrer">
    </form>
</div>

{{ include('layouts/footer.php') }}