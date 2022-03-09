<script>
    import { params } from '@/config/config.js'
    import { slevels } from '@/config/config_slevels.js'


    import Layout from '@/Pages/Shared/Layout.svelte'
    import Header from '@/Pages/Shared/Header/Header.svelte'

    export let skilltree

    import { printOrder } from "@/Pages/Shared/Functions/tree.js";

    let orderedSkills = printOrder(skilltree)

    console.log(orderedSkills)


  </script>
        
  
  <svelte:head>
      <title>{params.app.name} - Required Skills and Skill Levels</title>
  </svelte:head>
      
  <Layout>
  
    <section class="section container">

        <Header header="{{ title:'Required Skills and Skill Levels',subtitle:'Proficiency Level Definitions',isdefault:true }}" />


        {#each orderedSkills as skill}

            <p>{@html skill.title_en}</p>

            <div class="control">

                {#each slevels as level}
                <label class="radio">
                  <input type="radio" name="level{level.id}">
                  {level.title}
                </label><br>
                {/each}

            </div>

        {/each}
    
    </section>
  
  </Layout>