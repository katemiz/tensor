<script>

    import {params} from '@/config/config.js'

    import { page, Link } from '@inertiajs/inertia-svelte'
    import Icon from '@/Pages/Shared/Icon.svelte'

    let iconColor = 'link'
    let iconSize = 'S'

    let user = false

    if ($page.props.auth) {

        user = $page.props.auth.user
    }

    console.log($page.props)

</script>

<nav class="navbar is-light is-transparent">

    <div class="navbar-brand">

        <a class="navbar-item has-text-white" href="/">
            <img src="/images/{params.app.app_header_logo}" alt="Skill Management Logo" width="112" height="28" >
        </a>

        <a role="button" onclick="BurgerMenu(this)" class="navbar-burger" data-target="navbar_ana" aria-label="menu" aria-expanded="false" id="nav-toggle">
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
        </a>

    </div>

    <div id="navbar_ana" class="navbar-menu">

        <div class="navbar-start" id="navstart">

            {#if user }

            <a class="navbar-item" href="/"><Icon name="home" size="{iconSize}" color="{iconColor}"/></a>
            <a class="navbar-item" href="/roles"><Icon name="role" size="{iconSize}" color="{iconColor}"/>&nbsp;Roles</a>
            <a class="navbar-item" href="/skills"><Icon name="skill" size="{iconSize}" color="{iconColor}"/>&nbsp;Skills</a>
            <a class="navbar-item" href="/"><Icon name="training" size="{iconSize}" color="{iconColor}"/>&nbsp;Trainings</a>
            <a class="navbar-item" href="/"><Icon name="measurement" size="{iconSize}" color="{iconColor}"/>&nbsp;measurement</a>

            <div class="navbar-item has-dropdown is-hoverable">

                <a class="navbar-link" href="/Admin">Admin</a>

                <div class="navbar-dropdown">

                    <a class="navbar-item" href="/projects">Projects</a>
                    <hr class="navbar-divider">

                    <a class="navbar-item" href="/bcategory">Business Categories</a>
                    <a class="navbar-item" href="/">Training Categories</a>
                    <a class="navbar-item" href="/simpleitem/profession">Professions</a>
                    <a class="navbar-item" href="/simpleitem/diploma">Diploma</a>

                    <hr class="navbar-divider">
                    <a class="navbar-item" href="/slevels">Proficiency Levels</a>
                    <a class="navbar-item" href="/simpleitem/language">Foreign Language</a>


                    <hr class="navbar-divider">
                    <a class="navbar-item" href="/">Responsibilities</a>
                    <a class="navbar-item" href="/">Responsibility Action Codes</a>

                </div>

            </div>

            {/if}

        </div>


        <div class="navbar-end" >

            <div class="navbar-item">
                <div class="buttons">

                {#if user}

                    <div class="navbar-item has-dropdown is-hoverable">
                        <a href="{"#"}" class="navbar-link">
                            <Icon name="user" size="{iconSize}" color="{iconColor}"/>&nbsp;{user.lastname.toUpperCase()}
                        </a>
                
                        <div class="navbar-dropdown">
                            <p class="navbar-item">{user.name} {user.lastname}</p>
                            <Link href="/projects" class="navbar-item" method="post" preserveScroll>
                                Projects
                            </Link>
                            <Link href="/logout" class="navbar-item" method="post" preserveScroll>
                                Logout
                            </Link>

                        </div>
                    </div>

                {:else}

                    <Link href="/login" class="button is-ghost" as="button" preserveScroll>
                        <Icon name="user" size="{iconSize}" color="{iconColor}"/>&nbsp;Login
                    </Link>

                    <Link href="/register" class="button is-ghost" as="button" preserveScroll>
                        <Icon name="register" size="{iconSize}" color="{iconColor}"/>&nbsp;Register
                    </Link>

                {/if}

                </div>
            </div>

        </div>

    </div>

</nav>




