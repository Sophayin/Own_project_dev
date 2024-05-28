<div>
    <section class="section">

        <div class="d-flex d-block mx-2 mb-3">
            <span style="border-bottom: dotted;border-color: #e5e5e5;">{{__('Agency Structure')}}</span>
        </div>

        <div class="card col-lg-12 col-sm-6">
            <div class="row">
                <div class="col-lg-12 d-flex">
                    <div class="col-lg-12 p-2">
                        <select wire:model.live="agency_id" id="selectleader" class="form-control form-select border-0 bg-light">
                            @foreach ($agencies as $agency)
                            <option value="{{ $agency->id }}">
                                {{ $agency->code ? '('.$agency->code.') - ' : '' }} {{$agency->full_name }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="container">
                    <div class="col-lg-12 col-sm-6 p-3">
                        <style>
                            .node {
                                cursor: pointer;
                            }

                            .node circle {
                                fill: #fff;
                                stroke: steelblue;
                                stroke-width: 1px;
                            }

                            .node text {
                                font: 13px sans-serif;
                            }

                            .link {
                                fill: none;
                                stroke: #0e90d2;
                                stroke-width: 1px;
                            }
                        </style>

                        <div class="col-md-12 col-sm-12 ">
                            <div class="x_panel">
                                <!--<div class="x_title">
                                    <div class="clearfix"></div>
                                    <button class="button btn btn-outline-primary" type="button" onclick="expandAll()"><i class="bi bi-arrows-angle-expand"></i>

                                    </button>
                                    <button class="button btn btn-outline-danger" type="button" onclick="collapseAll()">
                                        <i class="bi bi-arrows-angle-contract"></i>
                                    </button>
                                </div>-->
                                <div class="x_content text-center table-responsive col-12">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@push('scripts')
<script>
    Livewire.on('findAgencyLeader', postId => {
        jQuery(document).ready(function() {
            $('#selectleader').select2();
        });
    })

    jQuery(document).ready(function() {
        $('#selectleader').on('change', function(e) {
            @this.set('agency_id', $(this).val());
        });
    });
</script>
@endpush

@push('scripts')
<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/d3/7.9.0/d3.min.js"></script>-->

<script type="text/javascript">
    var treeData = [
        @json($data)
    ];
    var height = 1700;
    if (window.innerWidth < 360)
        var height = window.innerWidth * 0.85;
    else if (window.innerWidth < 1920)
        var height = window.innerWidth * 0.85;
    var margin = {
            top: 40,
            right: 0,
            bottom: 20,
            left: 0
        },
        width = window.innerWidth,
        height = height - margin.top - margin.bottom;

    var i = 0,
        duration = 700,
        root;

    var tree = d3.layout.tree()
        .size([height, width]);

    var diagonal = d3.svg.diagonal()
        .projection(function(d) {
            return [d.x, d.y];
        });

    var svg = d3.select(".x_content").append("svg")
        .attr("width", width + margin.right + margin.left)
        .attr("height", height + margin.top + margin.bottom)
        .append("g")
        .attr("transform", "translate(" + margin.left + "," + margin.top + ")");

    root = treeData[0];

    update(root);

    d3.select(self.frameElement).style("height", "500px");

    function update(source) {
        var nodes = tree.nodes(root).reverse(),
            links = tree.links(nodes);

        nodes.forEach(function(d) {
            d.y = d.depth * 150;
        });

        var node = svg.selectAll("g.node")
            .data(nodes, function(d) {
                return d.id || (d.id = ++i);
            });

        var tooltip2 = d3.select(".x_content")
            .append("div")
            .style("position", "absolute")
            .style("visibility", "hidden")
            .style("background-color", "white")
            .style("border", "solid")
            .style("border-color", "#0e90d2")
            .style("border-width", "1px")
            .style("border-radius", "10px")
            .style("padding", "10px");

        var nodeEnter = node.enter().append("g")
            .attr("class", "node")
            .attr("transform", function() {
                return "translate(" + source.x0 + "," + source.y0 + ")";
            })
            .on("click", click)
            .on("mouseover", function(d) {
                let agency_profile = d.gender == "Female" ? "female.svg" : "male.png";

                var imageUrl = d.agency_profile ? "<?php echo url('/'); ?>/" + d.agency_profile : "<?php echo url('/'); ?>" + "/assets/avatar/" + agency_profile
                return tooltip2.style("visibility", "visible")
                    .html("<h6 class='text-primary'> " + d.full_name + " </h6>" +
                        "<h6>{{__('Code')}} : " + d.code + "</h6>" +
                        "<h6>{{__('Phone Number')}}: " + d.phone + "</h6>" +
                        "<h6>{{__('Gender')}} : " + d.gender + "</h6>" +
                        "<img class='shadow p-3 bg-white rounded' style='border-radius: 50%;' height='250px' src='" + imageUrl + "'></img>"
                    );
            })
            .on("mousemove", function() {
                return tooltip2.style("top", (event.pageY - 100) + "px").style("left", (event.pageX - 390) + "px");
            })
            .on("mouseout", function() {
                return tooltip2.style("visibility", "hidden");
            });

        nodeEnter.append("image")
            .attr("xlink:href", function(d) {
                if (d.agency_profile) {
                    return "<?php echo url('/'); ?>/" + d.agency_profile;
                } else {
                    let agency_profile = d.gender == "Female" ? "female.svg" : "male.png";
                    return "<?php echo url('/'); ?>" + "/assets/avatar/" + agency_profile
                }
            })
            .attr("x", function(d) {
                return -30;
            })
            .attr("y", function(d) {
                return -30;
            })
            .style("border-radius", 50)
            .attr("width", 60)
            .attr("height", 60);


        nodeEnter.append("text")
            .attr("x", function(d) {
                return d.children || d._children ? -40 : 40;
            })
            .attr("dy", "0.5em") // Adjust the vertical alignment as needed
            .style("text-anchor", "middle") // Center-align the text
            .style("fill-opacity", 1e-6)
            .attr("transform", "translate(0, 30)") // Adjust the margin-top as needed
            .style("font-weight", "bold") // Make the text bold
            .each(function(d) {
                // Split code and full_name into separate lines using tspan
                var text = d3.select(this);
                var lines = (d.code + ' - ' + d.full_name).split(' - ');
                text.selectAll('tspan')
                    .data(lines)
                    .enter()
                    .append('tspan')
                    .text(function(line) {
                        return line;
                    })
                    .attr('dy', '1.2em') // Adjust the line spacing as needed
                    .attr('x', 0); // Center-align the tspan within the text element
            });

        var nodeUpdate = node.transition()
            .duration(duration)
            .attr("transform", function(d) {
                return "translate(" + d.x + "," + d.y + ")";
            });

        nodeUpdate.select("circle")
            .attr("r", 12)
            .style("fill", function(d) {
                return d._children ? "lightsteelblue" : "#fff";
            });

        nodeUpdate.select("text")
            .style("fill-opacity", 1);

        // Transition exiting nodes to the parent's new position.
        var nodeExit = node.exit().transition()
            .duration(duration)
            .attr("transform", function() {
                return "translate(" + source.x + "," + source.y + ")";
            })
            .remove();

        nodeExit.select("circle")
            .attr("r", 1e-6);

        nodeExit.select("text")
            .style("fill-opacity", 1e-6);

        var link = svg.selectAll("path.link")
            .data(links, function(d) {
                return d.target.id;
            });

        link.enter().insert("path", "g")
            .attr("class", "link")
            .attr("stroke-width", function() {
                return 1;
            })
            .attr("d", function() {
                var o = {
                    x: source.x0,
                    y: source.y0
                };
                return diagonal({
                    source: o,
                    target: o
                });
            });


        link.transition()
            .duration(duration)
            .attr("d", diagonal);

        link.exit().transition()
            .duration(duration)
            .attr("d", function() {
                var o = {
                    y: source.y,
                    x: source.x
                };
                return diagonal({
                    source: o,
                    target: o
                });
            })
            .remove();

        nodes.forEach(function(d) {
            d.y0 = d.y;
            d.x0 = d.x;
        });
    }

    function click(d) {
        if (d.children) {
            d._children = d.children;
            d.children = null;
        } else {
            d.children = d._children;
            d._children = null;
        }
        update(d);
    }

    function collapse(d) {
        if (d.children) {
            d._children = d.children;
            d._children.forEach(collapse);
            d.children = null;
        }
    }

    function collapseAll() {
        root.children.forEach(collapse);
        update(root);
    }

    function expand(d) {
        if (d._children) {
            d.children = d._children;
            d._children = null;
        }
        if (d.children) {
            d.children.forEach(expand);
        }
    }

    function expandAll() {
        root.children.forEach(expand);
        update(root);
    }
</script>
@endpush