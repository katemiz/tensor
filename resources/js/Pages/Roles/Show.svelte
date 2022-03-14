<script>

    import { params,gui } from '@/config/config.js'
    import { pageprops,formprops } from '@/config/config_roles.js'
    import { slevels } from '@/config/config_slevels.js'
    import { langlevels } from '@/config/config_langlevels.js'


    

    import Layout from '@/Pages/Shared/Layout.svelte'
    import Icon from '@/Pages/Shared/Icon.svelte'
    import Notification from '@/Pages/Shared/Notification/Notification.svelte'

    export let item
    export let skills
    export let languages
    export let notification

    console.log(item)
</script>

<svelte:head>
    <title>{params.app.name} - {pageprops.headers.show}</title>
</svelte:head>



<Layout>

    <section class="section container">


        <div class="columns">

            <div class="column">
                <h1 class="title has-text-weight-semibold">{item.title_en}</h1>
                <h2 class="subtitle has-text-info">{item.title_tr}</h2>
            </div>

            <div class="column is-1 is-pulled-right">
                <a href="/roles/form/{item.id}">
                <Icon name="edit" size="{gui.icons.size}" color="{gui.icons.color}"/>
                </a>
            </div>

        </div>

        <Notification {notification} />

        {#if item.desc_en.length > 0}

        <h6 class="subtitle is-size-6 my-3 has-text-danger-dark">{formprops.editor_en.label}</h6>

        {@html item.desc_en}

        {/if}

        
        {#if item.desc_tr.length > 0}

        <h6 class="subtitle is-size-6 my-3 has-text-danger-dark">{formprops.editor_tr.label}</h6>

        {@html item.desc_tr}

        {/if}

    
        <!-- EDUCATION LEVELS -->

        <h6 class="subtitle is-size-6 my-3 has-text-danger-dark">Education Requirements</h6>




        <!-- PROFESSION       -->

        <h6 class="subtitle is-size-6 my-3 has-text-danger-dark">Profession Requirement</h6>





        <h6 class="subtitle is-size-6 my-3 has-text-danger-dark">Experience Requirements</h6>






        <!-- SKILLS          -->

        <div class="columns">

            <div class="column">
                <h6 class="subtitle is-size-6 my-3 has-text-danger-dark">Required Skills and Skill Levels</h6>
            </div>

            <div class="column is-1 is-pulled-right">
                <a href="/role-skills/{item.id}">
                <Icon name="edit" size="{gui.icons.size}" color="{gui.icons.color}"/>
                </a>
            </div>

        </div>


        

        {#if skills.length > 0}
        <table class="table is-narrow is-fullwidth">

            <thead>
            <tr>
                <th>No</th>
                <th>Required Skill Title</th>
                <th class="has-text-right">Required Skill Level</th>
            </tr>
            </thead>

            {#each skills as skill,key}
            <tr>
                <td>{key+1}</td>
                <td>{skill.title_en}</td>

                {#if skill.pivot.level >0 }
                <td class="has-text-right">{skill.pivot.level} - { slevels.filter(el => el.level === skill.pivot.level)[0].title}</td>
                {:else}
                <td class="has-text-right">Not Set</td>
                {/if}
            </tr>

            {/each}

        </table>
        {:else}

            <div class="notification is-warning is-light">
            No skills for this role yet.
            </div>

        {/if}


        <div class="columns">

            <div class="column">
                <h6 class="subtitle is-size-6 my-3 has-text-danger-dark">Foreign Language Requirements</h6>
            </div>

            <div class="column is-1 is-pulled-right">
                <a href="/role-language/{item.id}">
                <Icon name="edit" size="{gui.icons.size}" color="{gui.icons.color}"/>
                </a>
            </div>

        </div>


        {#if languages.length > 0}
        <table class="table is-narrow is-fullwidth">

            <thead>
            <tr>
                <th>No</th>
                <th>Language Knowledge</th>
                <th class="has-text-right">Language Level</th>
            </tr>
            </thead>

            {#each languages as lang,key}
            <tr>
                <td>{key+1}</td>
                <td>{lang.title}</td>

                {#if lang.pivot.level }
                <td class="has-text-right">{lang.pivot.level} - { langlevels.filter(el => el.level == lang.pivot.level)[0].title}</td>
                {:else}
                <td class="has-text-right">Not Set</td>
                {/if}
            </tr>

            {/each}

        </table>
        {:else}

            <div class="notification is-warning is-light">
            No language requirement for this role yet.
            </div>

        {/if}
















    </section>
      
  </Layout>