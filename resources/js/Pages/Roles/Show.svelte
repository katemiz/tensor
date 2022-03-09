
<script>

    import {params,gui} from '@/config/config.js'
    import {pageprops} from '@/config/config_roles.js'

    import Layout from '@/Pages/Shared/Layout.svelte'
    import Header from '@/Pages/Shared/Header/Header.svelte'
    import Icon from '@/Pages/Shared/Icon.svelte'

    import Notification from '@/Pages/Shared/Notification/Notification.svelte'
    import ItemInfo from '@/Pages/Shared/Notification/ItemInfo.svelte'

    export let item
    export let notification

    console.log(item)
</script>

<svelte:head>
    <title>{params.app.name} - {pageprops.headers.show}</title>
</svelte:head>



<Layout>

    <section class="section container">
  
        <Header header="{{ title:pageprops.page.title,subtitle:pageprops.page.subtitle,type:pageprops.page.type.type }}" />

        <Notification {notification} />

        <div class="columns">
    
            <div class="column is-3">

                <a href="/roles-list">All Roles List</a>
                <aside class="menu">
                    <p class="menu-label">Requirements</p>
                    <ul class="menu-list">
                        <li><a href="/roles/list">Role Definition</a></li>
                        <li><a href="/roles/form/new">Education</a></li>
                        <li><a href="/roles/form/new">Profession</a></li>
                        <li><a href="/roles/form/new">Experience</a></li>
                        <li><a href="/select-skills">Skills</a></li>
                        <li><a href="/roles/form/new">Trainings</a></li>
                        <li><a href="/roles/form/new">Language</a></li>
                    </ul>
                </aside> 
            </div>
    
            <div class="column">

                <Header header="{{ title:"Role Definition" }}" />


                <div class="card">

                    <div class="card-content">
                        <div class="media">
                            <div class="media-content">
                                <p class="title is-4 my-1">{item.title_en}</p>
                                <p class="title is-4 my-1 has-text-grey">{item.title_tr}</p>
                                <p class="subtitle is-6 mt-3">{item.title_tr}</p>
                            </div>
                        </div>
                    
                        <div class="content">
                
                            {@html item.desc_en}
                            {@html item.desc_tr}
                
                        </div>
                    </div>
                
                
                    <footer class="card-footer">
                
                        <a href="{"#"}" class="card-footer-item"  data-id={item.id}>
                            <Icon name="add" size="{gui.icons.size}" color="{gui.icons.color}"/>&nbsp;Add Child
                        </a>
                
                        <a href="{"#"}" class="card-footer-item" >
                            <Icon name="edit" size="{gui.icons.size}" color="{gui.icons.color}"/>&nbsp;Edit
                        </a>
                
                        {#if item.children == undefined || item.children.length == 0}
                            <a href="{"#"}" class="card-footer-item"  data-id={item.id}>
                                <Icon name="delete" size="{gui.icons.size}" color="danger"/>&nbsp;Delete
                            </a>
                        {/if}
                
                    </footer>
                
                </div>

                <ItemInfo {item} />


                <Header header="{{ title:"Education Requirements" }}" />


                <Header header="{{ title:"Profession Requirements" }}" />

                <Header header="{{ title:"Experience Requirements" }}" />


                <Header header="{{ title:"Required Skills and Skill Levels" }}" />

                <Header header="{{ title:"Language Requirements" }}" />




            </div>
    
        </div>
  
    </section>
      
  </Layout>