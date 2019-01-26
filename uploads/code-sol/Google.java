import java.io.File;
import java.util.ArrayList;
import java.util.Scanner;
import java.util.Vector;

class Node1
{
    String             name; // node ID, started from 0 to n-1
    Vector<Integer> preds; // predecessors (String)
    Vector<Integer> neibs; // neighbors (String)
    Vector<Integer> backs; // backward edges -node is end vertex (Integer)
    Vector<Integer> fors; // forward edges -node is start vertex (Integer)
    String             pNode; // previous node on the augmenting path
    int             pEdge; // from which edge this node comes on the augmenting
    // path

    public Node1(String id)
    {
        name = id;
        backs = new Vector<Integer>();
        fors = new Vector<Integer>();

        pNode = null;
        pEdge = -1;
    }
}

class Edge
{
    int name;    // edge ID, started from 0 to n-1
    String start;   // start vertex of this edge
    String end;     // end vertex of this edge
    int direct;  // forwards (+1) or backwards (-1) on augmenting path
    // if 0 then not part of augmenting path
    int capacity; // capacity
    int flow;    // current flow

    public Edge(int id)
    {
        name = id;
        start = null;
        end = null;
        direct = 0; // default is neither
        capacity = 0;
        flow = 0;
    }

    public String toString()
    {
        return name + ": s=" + start + " e=" + end + " d=" + direct;
    }
}

public class Google
{
    int    n;                      // number of nodes
    int    target;                 // destination node
    int    minLength;              // the minimal length of each path
    Node1[] v;                      // used to store Nodes
    Edge[] e;                      // used to store Edges
    int[]  path;                   // used to store temporary path
    int    length       = 0;       // length of the path
    int    distance     = 0;       // distance of the path
    int[]  bestPath;               // used to store temporary path
    int    bestLength   = 0;       // length of the longest path
    int    bestDistance = -1000000; // distance of the longest path
    int[]  visited;                // used to mark a node as visited if set as
    // 1
    ArrayList<Node1> nodes;
    ArrayList<String> nodeNames;
    ArrayList<Edge> edges;


    public Google() throws Exception
    {
        Scanner sc = new Scanner(new File("google.in"));
        nodes = new ArrayList<>();
        edges = new ArrayList<>();
        nodeNames = new ArrayList<>();

        int i = 0;
        while (sc.hasNextLine())
        {
            String l = sc.nextLine();
            Edge edge = new Edge(i);
            String sVal = l.split(" to ")[0];
            edge.start = sVal;

            String s2 = l.split(" to ")[1];
            String eVal="";
            String cap="";
            for (int i1 = 0; i1 < s2.length(); i1++) {
                if(s2.charAt(i1)>='0' && s2.charAt(i1) <='9')
                    cap+=s2.charAt(i1)+"";
                else
                    eVal+=s2.charAt(i1)+"";
            }
            eVal = eVal.substring(0,eVal.length()-1);

            edge.end = eVal;
            edge.capacity = Integer.parseInt(cap);
            edge.flow = 0;
            edges.add(edge);

            if(nodeNames.indexOf(sVal) == -1) {
                nodes.add(new Node1(sVal));
                nodeNames.add(sVal);
            }
            if(nodeNames.indexOf(eVal) == -1) {
                nodes.add(new Node1(eVal));
                nodeNames.add(eVal);
            }

            nodes.get(nodeNames.indexOf(sVal)).fors.add(i);
            nodes.get(nodeNames.indexOf(eVal)).backs.add(i);
            i++;
        }

        v = nodes.toArray(new Node1[nodes.size()]);
        e = edges.toArray(new Edge[edges.size()]);
        visited = new int[v.length];
        path = new int[v.length];
        bestPath = new int[v.length];

        sc.close();
    }

    /*
     * this function looks for a longest path starting from being to end,
     * using the backtrack depth-first search.
     */
    public boolean findLongestPath(int begin, int end, int minLen)
    {
        /*
         * compute a longest path from begin to end
         */
        target = end;
        bestDistance = -100000000;
        minLength = minLen;
        dfsLongestPath(begin);
        if (bestDistance == -100000000)
            return false;
        else
            return true;
    }

    private void dfsLongestPath(int current)
    {
        visited[current] = 1;
        path[length++] = current;
        if (current == target && length >= minLength)
        {
            if (distance > bestDistance)
            {
                for (int i = 0; i < length; i++)
                    bestPath[i] = path[i];
                bestLength = length;
                bestDistance = distance;
            }
        }
        else
        {
            Vector<Integer> fors = v[current].fors;
            for (int i = 0; i < fors.size(); i++)
            {
                Integer edge_obj = (Integer) fors.elementAt(i);
                int edge = edge_obj.intValue();
                if (visited[nodeNames.indexOf(e[edge].end)] == 0)
                {
                    distance += e[edge].capacity;
                    dfsLongestPath(nodeNames.indexOf(e[edge].end));
                    distance -= e[edge].capacity;
                }
            }
        }
        visited[current] = 0;
        length--;
    }

    public String toString()
    {
        String output =  nodeNames.get(bestPath[0]);
        for (int i = 1; i < bestLength; i++)
            output = output + " -> " + nodeNames.get(bestPath[i]);
        return output;
    }

    public static void main(String arg[]) throws Exception
    {
        Google lp = new Google();
        /*
         * find a longest path from vertex 0 to vertex n-1.
         */
        if (lp.findLongestPath(lp.nodeNames.indexOf("UHS"), lp.nodeNames.indexOf("OTHS"), 1))
            System.out.print(lp
                    + "\n" + lp.bestDistance);
    }
}