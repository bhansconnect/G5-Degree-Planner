import math
import MySQLdb
import re
import sys


# would normal grab degree information here but instead I am faking it for testing
degree = ""
courses = []
complete = []
courses_a_semester = 5

if len(sys.argv) > 1:
    #print("loading info for user:", sys.argv[1])
    db = MySQLdb.connect("141.219.214.79", "degreePlanner", "teamsoftware", "TSP")
    cursor = db.cursor()
    query = "SELECT * from profiles WHERE username='" + sys.argv[1] + "'"
    cursor.execute(query)
    data = cursor.fetchone()
    if data[3] != '':
        degree = data[3]
    else:
        print("Please pick a Major!")
        sys.exit()
    if degree == "Computer Science":
        courses_a_semester = 3
    complete = data[5].split(", ")
    query = "SELECT * from majors WHERE major='" + degree + "'"
    cursor.execute(query)
    data = cursor.fetchone()
    courses = data[1].split(", ")
    for c in complete:
        if c not in courses:
            courses.append(c)
    db.close()
semesters = []

def is_digit(n):
    try:
        int(n)
        return True
    except ValueError:
        return  False

def parenthetic_contents(string):
    """Generate parenthesized contents in string as pairs (level, contents)."""
    stack = []
    for i, c in enumerate(string):
        if c == '(':
            stack.append(i)
        elif c == ')' and stack:
            start = stack.pop()
            yield (len(stack), string[start + 1: i])

def check_prereqs(input, prereqLength, prereqChain):
    #input = input.replace("(C)", "")
    exp = re.findall("[A-Z]{2,4}[ ]{1}[0-9]{4}[(]{1}[C]{1}[)]{1}", input)
    if exp:
        for group in exp:
            input = input.replace(group, "-1")

    # deal with parentheses
    exp = parenthetic_contents(input)
    if exp:
        for group in exp:
            if group[0] == 0:
                #print(input)
                group_with_parentheses = "(" + group[1] + ")"
                #print(group[1])
                input = input.replace(group_with_parentheses, str(check_prereqs(group[1], prereqLength, prereqChain)))
                #print(input)
                # print(str)

    # deal with 'and's
    groups = input.split(" and ")
    value = math.nan;
    for group in groups:
        # inside of ands deal with 'or's
        t = group.split(" or ")
        min = math.nan
        minPrereq = "null"
        for prereq in t:
            #print(prereq, " -> ", is_digit(prereq))
            # or logic
            if prereq in prereqLength:
                if not math.isnan(prereqLength[prereq]) and math.isnan(min):
                    min = prereqLength[prereq]
                    minPrereq = prereq
                elif not math.isnan(prereqLength[prereq]) and prereqLength[prereq] < min:
                    min = prereqLength[prereq]
                    minPrereq = prereq
            elif is_digit(prereq):
                if math.isnan(min):
                    min = int(prereq)
                    minPrereq = "null"
                elif int(prereq) < min:
                    min = int(prereq)
                    minPrereq = "null"

        if minPrereq != "null" and minPrereq not in prereqChain:
            prereqChain.append(minPrereq)

        # and logic
        if math.isnan(min):
            value = math.nan
            break
        elif math.isnan(value):
            value = min
        elif value < min:
            value = min
    return value

while set(courses) != set(complete):
    #print(set(courses))
    #print(set(complete))
    prereqLength = {}
    prereqChain = {}
    reversePrereqLength = {}
    for course in courses:
        prereqLength[course] = math.nan
        prereqChain[course] = []
        reversePrereqLength[course] = 0

    db = MySQLdb.connect("141.219.214.79", "degreePlanner", "teamsoftware", "TSP")

    cursor = db.cursor()

    prereqs = {}
    # get prereqs of every course
    for course in courses:
        query = "SELECT course_num, prereq from courses WHERE course_num='" + course + "'"
        cursor.execute(query)
        data = cursor.fetchall()
        prereqs[data[0][0]] = data[0][1]
        if data[0][1] == 'null':
            prereqLength[course] = 0
        if course in complete:
            prereqLength[course] = -1
    db.close()

    change = True
    while change:
        change = False
        for key, value in prereqLength.items():
            if math.isnan(prereqLength[key]):
                val = check_prereqs(prereqs[key], prereqLength, prereqChain[key])
                if not math.isnan(val):
                    change = True
                    prereqLength[key] = int(val) + 1

    for key in sorted(prereqLength, key=prereqLength.get, reverse=True):
        if prereqLength[key] == -1:
            reversePrereqLength[key] = -1
            continue
        for c in prereqChain[key]:
            if prereqLength[c] == -1:
                continue
            if reversePrereqLength[c] < reversePrereqLength[key] + 1:
                reversePrereqLength[c] = reversePrereqLength[key] + 1
    #for key in sorted(reversePrereqLength, key=reversePrereqLength.get, reverse=True):
    #    print(key, "->", reversePrereqLength[key])

    change = True
    while change:
        change = False
        for key, value in prereqChain.items():
            for course in value:
                if course in prereqChain.keys():
                    for prereq in prereqChain[course]:
                        if prereq not in prereqChain[key]:
                            change = True
                            prereqChain[key].append(prereq)

    maxPrereqChain = 0
    for value in prereqLength.values():
        if value > maxPrereqChain:
            maxPrereqChain = value
    #result = ""
    coursecount = {}
    for c in courses:
        coursecount[c] = 0
    for key, value in prereqChain.items():
        for c in value:
            coursecount[c] = coursecount[c] + prereqLength[key]*prereqLength[key]

    #for key, value in prereqLength.items():
    #    if value == 0:
    #        print(key)
    #print()

    sem = []
    for key in sorted(reversePrereqLength, key=reversePrereqLength.get, reverse=True):
        #print(key, "->", reversePrereqLength[key], "->", prereqLength[key])
        if len(sem) >= courses_a_semester:
            break
        if prereqLength[key] == 0:
            sem.append(key)
            complete.append(key)
            continue
        #count = 0
        #for c in prereqChain[key]:
        #    if prereqLength[c] == 0:
        #        count = count + 1
        #print(count)

    if (len(sem) == 0):
        break

    semesters.append(sem)
    #result = result + "<br>";
    #print(result)
    #if result == "<br>":
    #    break
nottaken = []
for c in courses:
    if c not in complete:
        nottaken.append(c)

if len(nottaken) == 0:
    db = MySQLdb.connect("141.219.214.79", "degreePlanner", "teamsoftware", "TSP")
    cursor = db.cursor()
    out = ""
    for i in range(len(semesters)):
        out = out + "Semester " + str(i+1) + ":<br><ul>"
        for c in semesters[i]:
            query = "SELECT course_name from courses WHERE course_num='" + c + "'"
            cursor.execute(query)
            data = cursor.fetchone()
            out = out + "<li>" + c + ": " + data[0] + "</li>"
        out = out + "</ul><br>"
    print(out)
    db.close()
else:
    print("You do not have the prerequisites for these course:", nottaken)