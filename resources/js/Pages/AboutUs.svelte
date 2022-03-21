<script>
  import {params} from '@/config/config.js'
  import Layout from '@/Pages/Shared/Layout.svelte'


  let kurucular = [
    {
      name:"Cemal Şenyılmaz",
      image:"csenyilmaz.jpg",
      email:"cmsnylmz@gmail.com",
      profession:"Mechanical Engineer",
      linkedin:"",
      cv:"has more than 30 years of expertise in various areas in aerospace industry. ",
      areas:[
        "Manufacturing Engineering/Planning",
        "Structural Engineering",
        "Product Development in Aerospace Industry",
        "Academy Management",
        "Human Resources Management"
      ],
      projects:[
        "F16",
        "CASA",
        "YARASA",
        "ATAK"
      ],
      positions:[
        "Manufacturing Engineer",
        "NC Programmer",
        "Structural Design Engineer",
        "Structural Design Department Chief",
        "Training Manager",
        "Vice President of Human Resources"
      ]
    },

    {
      name:"Kılıç Ali Temiz",
      image:"katemiz.jpg",
      email:"katemiz@gmail.com",
      profession:"Mechanical Engineer",
      linkedin:"",
      cv:"has more than 30 years of expertise in various areas in aerospace industry. ",
      areas:[
        "Manufacturing Engineering/Planning",
        "Structural Engineering",
        "Product Development in Aerospace Industry",
        "Academy Management",
        "Human Resources Management"
      ],
      projects:[
        "F16",
        "CASA",
        "YARASA",
        "ATAK"
      ],
      positions:[
        "Manufacturing Engineer",
        "NC Programmer",
        "Structural Design Engineer",
        "Structural Design Department Chief",
        "Training Manager",
        "Vice President of Human Resources"
      ]
    },




  ]

</script>




<svelte:head>

  <title>{params.app.title}</title>
  <meta name="description" content="{params.app.description}" />
    
</svelte:head>



<Layout>


  <div class="section container">

    <h1 class="title has-text-weight-semibold">Who Are We?</h1>
    <h2 class="subtitle has-text-info">Areas of Expertise</h2>

    <div class="columns">

      {#each kurucular as kurucu}
      <div class="column is-half">
        
        <div class="card">
          <div class="card-image">
            <figure class="image">
              <img src="/images/{kurucu.image}" alt="{kurucu.name}">
            </figure>
          </div>
          <div class="card-content">
            <div class="media">
              <div class="media-left">
                <figure class="image is-48x48">
                  <img src="/images/biz.png" alt="biz">
                </figure>
              </div>
              <div class="media-content">
                <p class="title is-4">{kurucu.name}</p>
                <p class="subtitle is-6">{kurucu.email}</p>
              </div>
            </div>

            <div class="content">

              <p>{kurucu.cv}</p>

              <h1 class="subtitle has-text-weight-light">Projects Involved</h1>
              <ul>
                {#each kurucu.projects as project}
                <li>{project}</li>
                {/each}
              </ul>

              <h1 class="subtitle has-text-weight-light">Positions Held</h1>
              <ul>
                {#each kurucu.positions as position}
                <li>{position}</li>
                {/each}
              </ul>

              <h1 class="subtitle has-text-weight-light">Areas of Expertise</h1>
              <ul>
                {#each kurucu.areas as area}
                <li>{area}</li>
                {/each}
              </ul>


            </div>
        
            <div class="content">
              Lorem ipsum dolor sit amet, consectetur adipiscing elit.
              Phasellus nec iaculis mauris. <a>@bulmaio</a>.
              <a href="#">#css</a> <a href="#">#responsive</a>
              <br>
              <time datetime="2016-1-1">11:09 PM - 1 Jan 2016</time>
            </div>
          </div>
        </div>


      </div>
      {/each}



    </div>


  </div>


</Layout>