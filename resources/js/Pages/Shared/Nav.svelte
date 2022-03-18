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

        <Link href="/" class="navbar-item has-text-white">
            <img src="/images/{params.app.app_header_logo}" alt="Skill Management Logo" width="112" height="28" >        
        </Link>


        <!-- <a class="navbar-item has-text-white" href="/">
            <img src="/images/{params.app.app_header_logo}" alt="Skill Management Logo" width="112" height="28" >
        </a> -->

<!--         <a role="button" onclick="BurgerMenu(this)" class="navbar-burger" data-target="navbar_ana" aria-label="menu" aria-expanded="false" id="nav-toggle">
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
        </a> -->


        <Link href="/" class="navbar-item has-text-white">
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>      
        </Link>



    </div>

    <div id="navbar_ana" class="navbar-menu">

        <div class="navbar-start" id="navstart">

            {#if user }

            <Link class="navbar-item" href="/"><Icon name="home" size="{iconSize}" color="{iconColor}"/></Link>
            <Link class="navbar-item" href="/roles"><Icon name="role" size="{iconSize}" color="{iconColor}"/>&nbsp;Roles</Link>
            <Link class="navbar-item" href="/skills"><Icon name="skill" size="{iconSize}" color="{iconColor}"/>&nbsp;Skills</Link>
            <Link class="navbar-item" href="/"><Icon name="training" size="{iconSize}" color="{iconColor}"/>&nbsp;Trainings</Link>
            <Link class="navbar-item" href="/"><Icon name="measurement" size="{iconSize}" color="{iconColor}"/>&nbsp;measurement</Link>

            <div class="navbar-item has-dropdown is-hoverable">

                <p class="navbar-link" href="/Admin">Admin</p>

                <div class="navbar-dropdown">

                    <!-- <a class="navbar-item" href="/projects">Projects</a> -->
                    <Link href="/projects" class="navbar-item">Projects</Link>

                    <hr class="navbar-divider">

                    <!-- <a class="navbar-item" href="/bcategory">Business Categories</a>
                    <a class="navbar-item" href="/">Training Categories</a>
                    <a class="navbar-item" href="/simpleitem/profession">Professions</a>
                    <a class="navbar-item" href="/simpleitem/diploma">Diploma</a>
                    <a class="navbar-item" href="/simpleitem/language">Language</a> -->

                    <Link href="/bcategory" class="navbar-item">Business Categories</Link>
                    <Link href="/" class="navbar-item">Training Categories</Link>
                    <Link href="/simpleitem/profession" class="navbar-item">Professions</Link>
                    <Link href="/simpleitem/diploma" class="navbar-item">Diploma</Link>
                    <Link href="/simpleitem/language" class="navbar-item">Language</Link>


                    <hr class="navbar-divider">
                    <!-- <a class="navbar-item" href="/slevels">Proficiency Levels</a> -->

                    <Link href="/slevels" class="navbar-item">Skill Levels</Link>

                </div>

            </div>

            {/if}

        </div>


        <div class="navbar-end" >

            <div class="navbar-item">
                <div class="buttons">

                {#if user}

                    <div class="navbar-item has-dropdown is-hoverable">
                        <p class="navbar-link">
                            <Icon name="user" size="{iconSize}" color="{iconColor}"/>&nbsp;{user.lastname.toUpperCase()}
                        </p>
                
                        <div class="navbar-dropdown">

                            <p class="navbar-item">{user.name} {user.lastname}</p>

                            <Link href="/projects" class="navbar-item">Projects</Link>
                            <Link href="/logout" class="navbar-item" method="post">Logout</Link>

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