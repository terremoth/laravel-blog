function build_choices(selector) {
    const sanitize_choice_list = (array_options) => {
        return [...new Set( array_options.split(',').map(item => item.trim()).filter(item => item.length > 0))];
    };

    const tags_element = document.querySelector(selector);
    const tag_element_name = tags_element.getAttribute('name');
    const tags_cleaned = sanitize_choice_list(tags_element.value);
    const tag_parent_element = tags_element.parentElement;
    tags_element.remove();
    let select_choices = document.createElement("select");
    select_choices.multiple = true;
    select_choices.setAttribute('id', 'tags');
    select_choices.classList.add('form-select');
    select_choices.name = tag_element_name+'[]';

    tags_cleaned.map(tag => {
        let option = document.createElement("option");
        option.setAttribute('selected', 'selected');
        option.innerHTML = tag;
        option.value = tag;
        select_choices.append(option);
    });

    tag_parent_element.append(select_choices);

    const element = document.querySelector(selector);

    const choices = window.tag_choices = new Choices(element, {
        editItems: true,
        addChoices: true,
    });

}

function addTagsChoicesFromAjax() {
    const choices = window.tag_choices;

    choices.setChoices(async () => {
        try {
            const items = await fetch('/tag-list');
            const json = await items.json();
            let arr = [];
            json.forEach(choice => {
                arr.push({
                    value: choice,
                    label: choice
                })
            });
            return arr;
        } catch (err) {
            console.error(err);
        }
    });
}

window.build_choices = build_choices;
window.addTagsChoicesFromAjax = addTagsChoicesFromAjax;
