/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   unit-test.c                                        :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: malallai <malallai@student.42.fr>          +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2019/04/13 16:16:17 by malallai          #+#    #+#             */
/*   Updated: 2019/04/13 17:19:07 by malallai         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

# include "libft/libft.h"
#include <stdlib.h>
#include <stdio.h>

# define RED (char *)"\033[0;31m"
# define GREEN (char *)"\033[0;32m"
# define WHITE (char *)"\033[0;0m"
# define YELLOW (char *)"\033[1;33m"

static	int		error;
static	char	*test_list[256];
static	int		tests;

static void	new_test(char *args)
{
	char	*tmp;

	tmp = ft_strjoin("./ft_ls ", args);
	tmp = ft_strjoin(tmp, " >> /dev/null");
	test_list[tests] = tmp;
	tests++;
}

static int	unit_test(char *test, int i)
{
	int		ret;

	ret = system(test);
	if (ret)
	{
		error++;
		printf("%sError %son test %s%d %s- '%s%s%s' (test %s%d%s/%s%d%s)\n", 
		RED, WHITE, RED, i, WHITE, YELLOW, test, WHITE, GREEN, i, WHITE, GREEN, tests, WHITE);
	}
	return (ret);
}

int		main(void)
{
	int i;

	i = 0;
	new_test("");
	new_test("-l");
	new_test("-la");
	new_test("-lr");
	new_test("-r");
	new_test("-lrt");
	new_test("-ltar");
	new_test("-l /tmp");
	new_test("/tmp");
	new_test("-R");
	new_test("-R /tmp");
	new_test("-R 42");
	new_test("-lRatr 42");
	new_test("-la ~");

	while (i < tests)
	{
		unit_test(test_list[i], i);
		i++;
	}
	if (!error)
		printf("%sAll test passed %s(%s%d%s/%s%d%s)\n", 
		GREEN, WHITE, GREEN, i, WHITE, GREEN, tests, WHITE);
	else
		printf("%s%d %stests failed. (%s%d%s/%s%d %spassed)\n", 
		RED, error, WHITE, GREEN, tests - error, WHITE, GREEN, tests, WHITE);
}
