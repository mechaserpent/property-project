<el-card>
    <div class="row">
        <div class="col-md-6">
            {{view|raw}}
        </div>
    </div>
</el-card>

<div id="div1">

</div>
<script>
    /* new Vue({
        el: "#div1",
        async created() {
            console.log("created");

            console.log((await this.$vx.get("/Updates/9/view?_entry=data")).data);

            this.$vx.post("/Document/test", {
                data: {
                    a: 1
                }
            });

        }
    }); */
</script>

<?php

return new class
{
    function get(VX $vx)
    {

        $view = $vx->ui->createView();
        $view->add("Date", "date");
        $view->add("Sequence", "sequence");
        $view->add("Type", fn ($o) => $o->Type());

        $view->add("Title[EN]", "title_en");
        $view->add("Title[TC]", "title_tc");
        $view->add("Title[SC]", "title_sc");

        $view->add("Created Time", "created_time");
        $view->add("Created", fn (Updates $o) => $o->CreatedBy());
        $view->add("Updated Time", "updated_time");
        $view->add("Updated By", fn (Updates $o) => $o->updatedBy());

        $view->add("File[EN]", function ($o) {
            return "<a href='/uploads/" . $o->file_en . "' target='_blank'>" . $o->file_en . "</a>";
        });

        $view->add("File[TC]", function ($o) {
            return "<a href='/uploads/" . $o->file_tc . "' target='_blank'>" . $o->file_tc . "</a>";
        });
        $view->add("File[SC]", function ($o) {
            return "<a href='/uploads/" . $o->file_sc . "' target='_blank'>" . $o->file_sc . "</a>";
        });

        if ($vx->user->isAdmin()) {
            $view->add("Link[EN]", "link_en");
            $view->add("Link[TC]", "link_tc");
            $view->add("Link[SC]", "link_sc");
        }

        $view->add("Status", fn ($o) => $o->status());

        $this->view = $view;
    }


    function data()
    {
        //return ["a", "b", "c"];
    }
};
