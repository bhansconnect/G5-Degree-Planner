import requests
import re
import csv


data = requests.get("https://www.banweb.mtu.edu/pls/owa/stu_ctg_utils.p_online_all_courses_ug")
text = data.text.replace("\n", "")
result = re.search('</table>(.*)</div>', text).group(1)
res_array = result.split("<br>")
dep = ""
courses = []
course = ""
name = ""
credits = ""
prereqs = ""
coreqs = ""
semesters = ""
for line in res_array:
    #print(line)
    #search for course id
    temp = re.search("<b>(.*) - ", line)
    check = re.search("(<b>Semesters Offered:</b> (.*))|(<b>Credits:</b> (.*))|(<b>Pre-Requisite\(s\):</b> (.*))|(<b>Co-Requisite\(s\):</b> (.*))", line)
    if temp is not None and check is None:
        if temp.group(1) != course and course != "":
            # print("Course: {0} - {1}".format(course, name))
            # print("\tDepartment: {0}".format(dep))
            # print("\tCredits: {0}".format(credits))
            # print("\tPrereqs: {0}".format(prereqs))
            # print("\tCoreqs: {0}".format(coreqs))
            # print("\tSemesters: {0}".format(semesters))
            courses.append((course, name, dep, credits, prereqs, coreqs, semesters))
            name = ""
            credits = ""
            prereqs = ""
            coreqs = ""
            semesters = ""
        course = temp.group(1)
    #search for course name
    temp = re.search(" - (.*)</b>", line)
    if temp is not None and check is None:
        name = temp.group(1)
    #search for credits
    temp = re.search("<b>Credits:</b> (.*)", line)
    if temp is not None:
        credits = temp.group(1)
    #search for semesters offered
    temp = re.search("<b>Semesters Offered:</b> (.*)", line)
    if temp is not None:
        semesters = temp.group(1)
    #search for prereqs
    temp = re.search("<b>Pre-Requisite\(s\):</b> (.*)", line)
    if temp is not None:
        prereqs = temp.group(1)
    #search for coreqs
    temp = re.search("<b>Co-Requisite\(s\):</b> (.*)", line)
    if temp is not None:
        coreqs = temp.group(1)
    #search for department
    temp = re.search("<h3>(.*)</h3>", line)
    if temp is not None:
        dep = temp.group(1)

with open('courses.csv', 'w', newline='') as csvfile:
    writer = csv.writer(csvfile)
    writer.writerow(("Course", "Department", "Credits", "Pre-Requisites", "Co-Requisites", "Semesters"))
    for c in courses:
        writer.writerow(c)
        # print("Course: {0} - {1}".format(c[0], c[1]))
        # print("\tDepartment: {0}".format(c[2]))
        # print("\tCredits: {0}".format(c[3]))
        # print("\tPrereqs: {0}".format(c[4]))
        # print("\tCoreqs: {0}".format(c[5]))
        # print("\tSemesters: {0}".format(c[6]))