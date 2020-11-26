#We are going to have a predefined Graph
graph = {'N':['Y','E'],
         'E':['E','L','N'],
         'E':['E'],
         'L':['E','A'],
         'A':['L'],
         'Y':['N']}


def bfs_connected_component(graph, start):
    explored = []
    queue = [start]
    levels = {}         


    visited= [start]    
    while queue:
        node = queue.pop(0)
        explored.append(node)
        neighbours = graph[node]

    
        for neighbour in neighbours:
            if neighbour not in visited:
                queue.append(neighbour)
                visited.append(neighbour)

                levels[neighbour]= levels[node]+1
                fringes[neighbour]= fringes[node]+1
                
    print(levels)
    i=0
    print("\nThe Fringe elements are ",end="")
    for keys in fringes:
        if(fringes[keys]==i):
            print(keys," ",end="")
            i+=1
    print("\n")

    return explored

ans = bfs_connected_component(graph,'A')
print("The shortest path is ",ans)