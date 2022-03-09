<script>
    import { params } from '@/config/config.js'
    import { slevels } from '@/config/config_slevels.js'

    import Layout from '@/Pages/Shared/Layout.svelte'
    import Header from '@/Pages/Shared/Header/Header.svelte'

  </script>
        
  
  <svelte:head>
      <title>{params.app.name} - (Skill) Proficiency Level Definitions</title>
  </svelte:head>
      
  <Layout>
  
    <section class="section container">

        <Header header="{{ title:'Skill Levels',subtitle:'Proficiency Level Definitions',isdefault:true }}" />

        <p class="mb-3">
            Proficiency Levels shown below can be used to identify skill/knowledge requirements for professions/titles/roles identified.
        </p>
    
        <p class="mb-3">
            The number of levels may depend upon the complexity of the process or an existing company approach. 
            <a href="https://www.sae.org/iaqg/projects/pcap001.pdf">[See Ref]</a>
        </p>
    
        <div class="tile is-ancestor my-4">
    
            <div class="tile is-vertical">


                {#each slevels as slevel}
                <div class="tile">
    
                    <div class="tile is-3 m-1">
                        <article class="tile is-child notification has-background-info-light">
                            <Header header="{{ title:slevel.title,subtitle:'Level '+slevel.level,isdefault:true }}" />
                        </article>
                    </div>
    
                    <div class="tile m-1">
    
                        <div class="tile is-vertical">
    
                            <div class="tile">
                                <article class="tile is-child notification">
                                    <h1 class="title has-text-weight-light mb-0 is-size-5 has-text-info-dark">Knowledge</h1>
                                    <p>{slevel.knowledge}</p>
                                </article>
                            </div>
    
                            <div class="tile my-1">
                                <article class="tile is-child notification">
                                    <h1 class="title has-text-weight-light mb-0 is-size-5 has-text-info-dark">Experience</h1>
                                    <p>{slevel.experience}</p>
                                </article>
                            </div>
    
                            <div class="tile">
                                <article class="tile is-child notification">
                                    <h1 class="title has-text-weight-light mb-0 is-size-5 has-text-info-dark">Autonomy</h1>
                                    <p>{slevel.autonomy}</p>
                                </article>
                            </div>
    
                        </div>
                    </div>
                </div>
                {/each}

            </div>
        </div>
    
    </section>
  
  </Layout>