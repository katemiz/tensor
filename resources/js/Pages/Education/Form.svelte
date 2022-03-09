<script>
    import { params,gui } from '@/config/config.js'
    import { Link } from '@inertiajs/inertia-svelte'
    import { Inertia } from '@inertiajs/inertia'

    import { pageprops } from '@/config/config_education.js'


    import Layout from '@/Pages/Shared/Layout.svelte'
    import EditorQuill from '@/Pages/Shared/Editor/EditorQuill.svelte'
    import Header from '@/Pages/Shared/Header/Header.svelte'
    import Icon from '@/Pages/Shared/Icon.svelte'

    export let item

    let editorProps
    let title
    let remarks
    let processing = false
    let submitbutton
    let header

    editorProps = pageprops.form.remarks

    // IF THIS IS EDIT
    if (item) {

        title = item.title
        remarks = {
            html:item.remarks,
            text:item.remarks_text
        }
        editorProps.content = item.remarks

        header = pageprops.header.update
        submitbutton = pageprops.form.submit.update.label
    } else {

        header = pageprops.header.new
        submitbutton = pageprops.form.submit.new.label
    }


    function readContent(event) {
		remarks = event.detail.icerik
    }


    function handleSubmit() {

        let values = {
            title:title,
            remarks:remarks
        }

        console.log(values)

        if (item) {

            values.id = item.id

            Inertia.put('/education', values,{
                onStart: () => {processing = true},
                onFinish: () => {processing = false},
            })

        } else {

            Inertia.post('/education', values,{
                onStart: () => {processing = true},
                onFinish: () => {processing = false},
            })
        }
    }

</script>


<svelte:head>
  <title>{params.app.name} - List of Education Levels</title>
  <link href="/css/quill.snow.css" rel="stylesheet">
</svelte:head>
  

<Layout>

<div class="section container">

    <Header header="{{ title:header }}" />

    <div class="column has-text-right">
        <Link href="/education" class="navbar-item">
          <Icon name="list" size="{gui.icons.size}" color="{gui.icons.color}"/> Back to List
        </Link> 
    </div>

    <form on:submit|preventDefault={handleSubmit} class="mx-4">

        <div class="box">
                            
            <div class="field">
                <label class="label" for="titleid">{pageprops.form.title.label}</label>
                <div class="control" id="titleid">
                    <input class="input" bind:value={title} type="text" placeholder="Enter education level title" >
                </div>
            </div>
                
            <EditorQuill props={editorProps} on:editordata={readContent}/>

            <div class="buttons is-right">
                <button class="button is-info" disabled={processing}>{submitbutton}</button>
            </div>

        </div>

    </form>
</div>
</Layout>