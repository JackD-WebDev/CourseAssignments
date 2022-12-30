<?php
    require("../my_sqli_connect.php" | "../../my_sqli_connect.php");
	session_start();
if ($_GET['function'] == "logout") {
		session_unset();
}

/** @noinspection PhpParamsInspection
 * @noinspection PhpUndefinedVariableInspection
 */
function displayPosts($type): void {
    global $dbc;
    if ($type == 'public') {
        $whereClause = "";
    } else if ($type == 'isfollowing') {
        $query = "SELECT * FROM `isFollowing` WHERE follower = " . mysqli_real_escape_string($dbc, $_SESSION['id']) . " LIMIT 1";
        $result = (mysqli_query($dbc, $query)) || [];
        $whereClause = "";
        while (($row = mysqli_fetch_assoc($result)) && $result != []) {
            if ($whereClause == "") $whereClause = "WHERE";
            else $whereClause.= " OR";
            $whereClause.= " userid = ".$row['isfollowing'];
        }
    } else if ($type == 'your-posts') {
        $whereClause = "WHERE userid = ". mysqli_real_escape_string($dbc, $_SESSION['id']);
    } else if ($type == 'search') {
        echo '<p>Showing search results for "'. mysqli_real_escape_string($dbc, $_GET['q']).'":</p>';
        $whereClause = "WHERE post LIKE '%". mysqli_real_escape_string($dbc, $_GET['q'])."%'";
    } else if (is_numeric($type)) {
        $userQuery = "SELECT * FROM `users` WHERE id = ".mysqli_real_escape_string($dbc, $type)." LIMIT 1";
            $userQueryResult = mysqli_query($dbc, $userQuery);
            $user = mysqli_fetch_assoc($userQueryResult);
        echo "<h2>".mysqli_real_escape_string($dbc, $user['email'])."'s Posts</h2>";
        $whereClause = "WHERE userid = ". mysqli_real_escape_string($dbc, $type);
    }
    $query = "SELECT * FROM `posts` ".$whereClause." ORDER BY `datetime` DESC LIMIT 10";
    $result = mysqli_query($dbc, $query);

    if (!$result || mysqli_num_rows($result) == 0) {
        echo "There are no posts to display.";
    } else {
        while ($row = mysqli_fetch_assoc($result)) {
            $userQuery = "SELECT * FROM `users` WHERE id = ".mysqli_real_escape_string($dbc, $row['userId'])." LIMIT 1";
            $userQueryResult = mysqli_query($dbc, $userQuery);
            $user = mysqli_fetch_assoc($userQueryResult);
            echo "<div class='posts'><p><a href='?page=publicprofiles&userid=".$user['id']."'>".$user['email']."</a> <span class='time'>".(time() - strtotime($row['datetime']))." ago</span>:</p>";
            echo "<p>".$row['post']."</p>";
            echo "<p><a class='toggleFollow' data-userId='".$row['userId']."'>";

            $isFollowingQuery = "SELECT * FROM `isFollowing` WHERE follower = ". mysqli_real_escape_string($dbc, $_SESSION['id'])." AND isfollowing = ". mysqli_real_escape_string($dbc, $row['userId'])." LIMIT 1";
        $isFollowingQueryResult = mysqli_query($dbc, $isFollowingQuery);
        if (mysqli_num_rows($isFollowingQueryResult) > 0) {

            echo "UNFOLLOW";

        } else {

            echo "FOLLOW";

        }

            echo "</a></p></div>";
        }
    }
}
function displaySearch(): void
{
    echo '<form>
        <div class="form-group">
            <input type="hidden" name="page" value="search">
            <input type="text" name="q" id="search" placeholder="search">
        </div>
        <button type="submit" class="button">SEARCH</button>
    </form>';
}

function displayPostBox(): void
{
    if ($_SESSION['id'] > 0) {
        echo '<div id="postSuccess" class="success">POST SUCCESSFUL</div><div id="postFail" class="fail"></div><div class="form">
            <div class="form-group">
                <textarea id="postContent"></textarea>
            </div>
            <button id="postButton" class="button">POST</button>
        </div>';
    }
}
function displayUsers(): void
{
    global $dbc;
    $query = "SELECT * FROM `users` LIMIT 10";
    $result = mysqli_query($dbc, $query);
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<p><a href='?page=publicprofiles&userid=".$row['id']."'>".$row['email']."</a></p>";
    }
}
